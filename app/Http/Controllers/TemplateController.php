<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\TemplatesCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

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
            'thumbnail_url' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'hero_image_url' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'html_path' => ['nullable', 'string'],
            'css_path' => ['nullable', 'string'],
            'js_path' => ['nullable', 'string'],

        ]);

        $slug = Str::slug($validated['slug']);

        $thumbnailPath = $request->file('thumbnail_url')->storeAs(
            "templates/{$slug}",
            'card.' . $request->file('thumbnail_url')->extension(),
            'public'
        );

        $heroImagePath = $request->file('hero_image_url')->storeAs(
            "templates/{$slug}",
            'hero.' . $request->file('hero_image_url')->extension(),
            'public'
        );

        
        $htmlPath = $request->file('html_file')->storeAs(
            "templates/{$slug}/source",
            'index.html',
            'public'
        );

        $cssPath = $request->file('css_file')->storeAs(
            "templates/{$slug}/source",
            'style.css',
            'public'
        );

        $jsPath = $request->file('js_file')->storeAs(
            "templates/{$slug}/source",
            'script.js',
            'public'
        );

        $template = Template::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['slug']),
            'template_category_id' => $validated['template_category_id'] ?? null,
            'short_description' => $validated['short_description'],
            'long_description' => $validated['long_description'] ?? null,
            'thumbnail_url' => $thumbnailPath,
            'hero_image_url' => $heroImagePath,
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active'),
            'html_path' => $htmlPath,
            'css_path' => $cssPath,
            'js_path' => $jsPath,
        ]);


        foreach ($request->benefits ?? [] as $index => $benefit) {

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

        foreach ($request->sections ?? [] as $index => $section) {

            if (empty($section['title'])) {
                continue;
            }

            $file = $request->file("sections.$index.image_url");

            $imageUrl = null;

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
            ->route('create-template')
            ->with('success', 'Template créé avec succès.');
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
            'html_path' => ['nullable', 'string'],
            'css_path' => ['nullable', 'string'],
            'js_path' => ['nullable', 'string'],
            'benefits' => ['nullable', 'array'],
            'sections' => ['nullable', 'array'],
        ]);

        $slug = Str::slug($validated['slug']);

        $thumbnailPath = $template->thumbnail_url;
        $heroImagePath = $template->hero_image_url;

        if ($request->hasFile('thumbnail_url')) {
            $thumbnailPath = $request->file('thumbnail_url')->storeAs(
                "templates/{$slug}",
                'card.' . $request->file('thumbnail')->extension(),
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

        if ($request->hasFile('html_file')) {
            if ($template->html_path) {
                Storage::disk('public')->delete($template->html_path);
            }

            $htmlPath = $request->file('html_file')->storeAs(
                "templates/{$slug}/source",
                'index.html',
                'public'
            );
        }

        if ($request->hasFile('css_file')) {
            if ($template->css_path) {
                Storage::disk('public')->delete($template->css_path);
            }

            $cssPath = $request->file('css_file')->storeAs(
                "templates/{$slug}/source",
                'style.css',
                'public'
            );
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
