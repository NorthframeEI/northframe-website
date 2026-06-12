<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
            'thumbnail_url' => ['nullable', 'string'],
            'hero_image_url' => ['nullable', 'string'],
            'demo_url' => ['nullable', 'string'],
        ]);

        $template = Template::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['slug']),
            'category' => $validated['category'] ?? null,
            'short_description' => $validated['short_description'],
            'long_description' => $validated['long_description'] ?? null,
            'thumbnail_url' => $validated['thumbnail_url'] ?? null,
            'hero_image_url' => $validated['hero_image_url'] ?? null,
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

            $template->sections()->create([
                'title' => $section['title'],
                'description' => $section['description'] ?? null,
                'image_url' => $section['image_url'] ?? null,
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
            'thumbnail_url' => ['nullable', 'string'],
            'hero_image_url' => ['nullable', 'string'],
            'demo_url' => ['nullable', 'string'],

            'benefits' => ['nullable', 'array'],
            'sections' => ['nullable', 'array'],
        ]);

        $template->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['slug']),
            'category' => $validated['category'] ?? null,
            'short_description' => $validated['short_description'],
            'long_description' => $validated['long_description'] ?? null,
            'thumbnail_url' => $validated['thumbnail_url'] ?? null,
            'hero_image_url' => $validated['hero_image_url'] ?? null,
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

            $template->sections()->create([
                'title' => $section['title'],
                'description' => $section['description'] ?? null,
                'image_url' => $section['image_url'] ?? null,
                'position' => $index,
            ]);
        }

        

        return redirect()
            ->route('list-templates')
            ->with('success', 'Template modifié avec succès.');
    }
}
