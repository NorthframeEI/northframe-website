<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\TemplatesCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Illuminate\Support\Facades\File;

class TemplateController extends Controller
{
    public function createTemplate()
    {
        $categories = TemplatesCategories::all();

        return view('admin.templates.create-template', compact('categories'));
    }

    public function storeTemplate(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:templates,slug'],
            'template_category_id' => ['nullable', 'exists:templates_categories,id'],
            'short_description' => ['required', 'string'],
            'long_description' => ['nullable', 'string'],

            'thumbnail_url' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ],

            'hero_image_url' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ],

            'template_zip' => [
                'required',
                'file',
                'mimes:zip',
                'max:51200'
            ],
        ]);


        $slug = Str::slug($validated['slug']);


        /*
    |--------------------------------------------------------------------------
    | Images template
    |--------------------------------------------------------------------------
    */

        $templateFolder = "templates/{$slug}";


        $thumbnailPath = $request->file('thumbnail_url')->storeAs(
            $templateFolder,
            'card.' . $request->file('thumbnail_url')->extension(),
            'public'
        );


        $heroImagePath = $request->file('hero_image_url')->storeAs(
            $templateFolder,
            'hero.' . $request->file('hero_image_url')->extension(),
            'public'
        );



        /*
    |--------------------------------------------------------------------------
    | ZIP extraction
    |--------------------------------------------------------------------------
    */


        $zip = new ZipArchive();


        $zipTemporaryPath = $request
            ->file('template_zip')
            ->getRealPath();



        if ($zip->open($zipTemporaryPath) !== true) {

            return back()
                ->withErrors([
                    'template_zip' => 'Impossible d’ouvrir le ZIP.'
                ])
                ->withInput();
        }



        /*
    |--------------------------------------------------------------------------
    | Vérification contenu ZIP
    |--------------------------------------------------------------------------
    */


        $requiredFiles = [
            'index.html',
            'style.css',
            'script.js',
        ];


        $missingFiles = [];


        foreach ($requiredFiles as $file) {

            if ($zip->locateName($file) === false) {
                $missingFiles[] = $file;
            }
        }



        $hasAssets = false;


        for ($i = 0; $i < $zip->numFiles; $i++) {

            $file = $zip->getNameIndex($i);


            if (
                str_starts_with($file, 'assets/')
            ) {
                $hasAssets = true;
                break;
            }
        }



        if (!empty($missingFiles)) {

            $zip->close();


            return back()
                ->withErrors([
                    'template_zip' =>
                    'Fichiers manquants : '
                        . implode(', ', $missingFiles)
                ])
                ->withInput();
        }



        if (!$hasAssets) {

            $zip->close();


            return back()
                ->withErrors([
                    'template_zip' =>
                    'Le dossier assets est obligatoire.'
                ])
                ->withInput();
        }




        /*
    |--------------------------------------------------------------------------
    | Extraction dans source
    |--------------------------------------------------------------------------
    */


        $sourcePath = storage_path(
            "app/public/{$templateFolder}/source"
        );


        File::ensureDirectoryExists($sourcePath);



        $zip->extractTo($sourcePath);


        $zip->close();

        File::deleteDirectory($sourcePath . '/__MACOSX');
        File::delete($sourcePath . '/.DS_Store');


        /*
    |--------------------------------------------------------------------------
    | Création template
    |--------------------------------------------------------------------------
    */


        $template = Template::create([

            'title' => $validated['title'],

            'slug' => $slug,

            'template_category_id' =>
            $validated['template_category_id'] ?? null,

            'short_description' =>
            $validated['short_description'],

            'long_description' =>
            $validated['long_description'] ?? null,


            'thumbnail_url' =>
            $thumbnailPath,

            'hero_image_url' =>
            $heroImagePath,


            'is_featured' =>
            $request->boolean('is_featured'),

            'is_active' =>
            $request->boolean('is_active'),



            'html_path' =>
            "{$templateFolder}/source/index.html",


            'css_path' =>
            "{$templateFolder}/source/style.css",


            'js_path' =>
            "{$templateFolder}/source/script.js",
        ]);





        /*
    |--------------------------------------------------------------------------
    | Benefits
    |--------------------------------------------------------------------------
    */

        foreach ($request->benefits ?? [] as $index => $benefit) {


            if (empty($benefit['title'])) {
                continue;
            }


            $template->benefits()->create([

                'icon' => null,

                'title' =>
                $benefit['title'],

                'description' =>
                $benefit['description'] ?? null,

                'position' =>
                $index,
            ]);
        }




        /*
    |--------------------------------------------------------------------------
    | Sections
    |--------------------------------------------------------------------------
    */

        foreach ($request->sections ?? [] as $index => $section) {


            if (empty($section['title'])) {
                continue;
            }



            $file =
                $request->file(
                    "sections.$index.image_url"
                );



            $imageUrl = null;



            if ($file) {


                $imageUrl = $file->storeAs(
                    "templates/{$slug}/sections",

                    "{$index}-"
                        . Str::slug($section['title'])
                        . "."
                        . $file->extension(),

                    'public'
                );
            }



            $template->sections()->create([

                'title' =>
                $section['title'],


                'description' =>
                $section['description'] ?? null,


                'image_url' =>
                $imageUrl,


                'position' =>
                $index,
            ]);
        }




        return redirect()
            ->route('create-template')
            ->with(
                'success',
                'Template créé avec succès.'
            );
    }

    public function listTemplates()
    {
        $templates = Template::with([
            'benefits',
            'sections',
            'category'
        ])
            ->latest()
            ->get();

        return view('admin.templates.index', compact('templates'));
    }

    public function deleteTemplate(Template $template)
    {
        Storage::disk('public')
            ->deleteDirectory("templates/{$template->slug}");

        $template->delete();

        return redirect()
            ->route('list-templates')
            ->with('success', 'Template supprimé avec succès.');
    }

    public function editTemplate(Template $template)
    {
        $template->load([
            'benefits',
            'sections',
        ]);

        $categories = TemplatesCategories::all();

        return view(
            'admin.templates.edit',
            compact('template', 'categories')
        );
    }

    public function updateTemplate(Request $request, Template $template)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('templates', 'slug')->ignore($template->id),
            ],
            'template_category_id' => ['nullable', 'exists:templates_categories,id'],
            'short_description' => ['required', 'string'],
            'long_description' => ['nullable', 'string'],
            'thumbnail_url' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'hero_image_url' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'template_zip' => [
                'nullable',
                'file',
                'mimes:zip',
                'max:51200'
            ],
            'benefits' => ['nullable', 'array'],
            'sections' => ['nullable', 'array'],
        ]);

        $slug = Str::slug($validated['slug']);

        $thumbnailPath = $template->thumbnail_url;
        $heroImagePath = $template->hero_image_url;

        if ($request->hasFile('thumbnail_url')) {
            $thumbnailPath = $request->file('thumbnail_url')->storeAs(
                "templates/{$slug}",
                'card.' . $request->file('thumbnail_url')->extension(),
                'public'
            );
        }

        if ($request->hasFile('hero_image_url')) {
            $heroImagePath = $request->file('hero_image_url')->storeAs(
                "templates/{$slug}",
                'hero.' . $request->file('hero_image_url')->extension(),
                'public'
            );
        }

        $htmlPath = $template->html_path;
        $cssPath = $template->css_path;
        $jsPath = $template->js_path;


        if ($request->hasFile('template_zip')) {


            $sourcePath = storage_path(
                "app/public/templates/{$slug}/source"
            );


            // Suppression ancienne version
            if (File::exists($sourcePath)) {
                File::deleteDirectory($sourcePath);
            }


            File::ensureDirectoryExists($sourcePath);



            $zip = new ZipArchive();


            if ($zip->open(
                $request->file('template_zip')->getRealPath()
            ) !== true) {

                return back()
                    ->withErrors([
                        'template_zip' => 'Impossible d’ouvrir le ZIP.'
                    ])
                    ->withInput();
            }



            // Vérification fichiers obligatoires

            $requiredFiles = [
                'index.html',
                'style.css',
                'script.js',
            ];


            foreach ($requiredFiles as $file) {

                if ($zip->locateName($file) === false) {

                    $zip->close();

                    return back()
                        ->withErrors([
                            'template_zip' =>
                            "Le fichier {$file} est manquant."
                        ])
                        ->withInput();
                }
            }



            // Vérification assets

            $hasAssets = false;


            for ($i = 0; $i < $zip->numFiles; $i++) {

                $fileName = $zip->getNameIndex($i);


                if (str_starts_with($fileName, 'assets/')) {

                    $hasAssets = true;
                    break;
                }
            }



            if (!$hasAssets) {

                $zip->close();

                return back()
                    ->withErrors([
                        'template_zip' =>
                        'Le dossier assets est obligatoire.'
                    ])
                    ->withInput();
            }



            $zip->extractTo($sourcePath);

            $zip->close();



            // Nettoyage MacOS

            File::deleteDirectory(
                $sourcePath . '/__MACOSX'
            );

            File::delete(
                $sourcePath . '/.DS_Store'
            );



            $htmlPath =
                "templates/{$slug}/source/index.html";


            $cssPath =
                "templates/{$slug}/source/style.css";


            $jsPath =
                "templates/{$slug}/source/script.js";
        }

        if ($request->hasFile('js_file')) {
            if ($template->js_path) {
                Storage::disk('public')->delete($template->js_path);
            }

            $jsPath = $request->file('js_file')->storeAs(
                "templates/{$slug}/source",
                'script.js',
                'public'
            );
        }

        $template->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['slug']),
            'template_category_id' => $validated['template_category_id'] ?? null,
            'short_description' => $validated['short_description'],
            'long_description' => $validated['long_description'] ?? null,
            'thumbnail_url' => $thumbnailPath,
            'hero_image_url' => $heroImagePath,
            'html_path' => $htmlPath,
            'css_path' => $cssPath,
            'js_path' => $jsPath,
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active'),
        ]);

        $template->benefits()->delete();
        $template->sections()->delete();

        foreach ($request->input('benefits', []) as $index => $benefit) {
            if (empty($benefit['title'])) {
                continue;
            }

            $template->benefits()->create([
                'icon' => null,
                'title' => $benefit['title'],
                'description' => $benefit['description'] ?? null,
                'position' => $index,
            ]);
        }

        foreach ($request->input('sections', []) as $index => $section) {
            if (empty($section['title'])) {
                continue;
            }
            $file = $request->file("sections.$index.image_url");

            $imageUrl = $section['existing_image'] ?? null;

            if ($file) {

                $imageUrl = $file->storeAs(
                    "templates/{$slug}/sections",
                    "{$index}-" . Str::slug($section['title']) . "." . $file->extension(),
                    'public'
                );
            }

            $template->sections()->create([
                'title' => $section['title'],
                'description' => $section['description'] ?? null,
                'image_url' => $imageUrl,
                'position' => $index,
            ]);
        }



        return redirect()
            ->route('list-templates')
            ->with('success', 'Template modifié avec succès.');
    }
}
