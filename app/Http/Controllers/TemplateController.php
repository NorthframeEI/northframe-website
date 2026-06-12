<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class TemplateController extends Controller
{
    public function createTemplate()
    {
        return view('admin.templates.create-template');
    }

    public function storeTemplate(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:templates,slug'],
            'category' => ['nullable', 'string', 'max:255'],
            'short_description' => ['required', 'string'],
            'long_description' => ['nullable', 'string'],
            'thumbnail_url' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'hero_image_url' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'demo_url' => ['nullable', 'string'],
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

        $template = Template::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['slug']),
            'category' => $validated['category'] ?? null,
            'short_description' => $validated['short_description'],
            'long_description' => $validated['long_description'] ?? null,
            'thumbnail_url' => $thumbnailPath,
            'hero_image_url' => $heroImagePath,
            'demo_url' => $validated['demo_url'] ?? null,
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active'),
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

        return view(
            'admin.templates.edit',
            compact('template')
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
            'category' => ['nullable', 'string', 'max:255'],
            'short_description' => ['required', 'string'],
            'long_description' => ['nullable', 'string'],
            'thumbnail_url' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'hero_image_url' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'demo_url' => ['nullable', 'string'],

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

        $template->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['slug']),
            'category' => $validated['category'] ?? null,
            'short_description' => $validated['short_description'],
            'long_description' => $validated['long_description'] ?? null,
            'thumbnail_url' => $thumbnailPath,
            'hero_image_url' => $heroImagePath,
            'demo_url' => $validated['demo_url'] ?? null,
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
