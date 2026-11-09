<?php

namespace App\Http\Controllers;

use App\Models\PortfolioProject;
use Illuminate\Http\Request;
use App\Services\PortfolioImageService;

class PortfolioController extends Controller
{
    public function index()
    {
        $projects = PortfolioProject::with('tags')
            ->latest()
            ->paginate(8);
        return view('admin.portfolio.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.portfolio.create');
    }


    public function store(Request $request, PortfolioImageService $imageService)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ],
            'url' => ['nullable', 'url'],
            'is_visible' => ['boolean'],
            'authorization_pending' => ['boolean'],
            'tags' => ['required', 'array', 'min:1'],
            'tags.*' => ['required', 'string', 'max:50'],
        ]);

        $imagePath = $imageService->store($request->file('image'));

        $project = PortfolioProject::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $imagePath,
            'url' => $validated['url'] ?? null,
            'is_visible' => $request->boolean('is_visible'),
            'authorization_pending' => $request->boolean('authorization_pending'),
        ]);

        foreach ($validated['tags'] as $tag) {
            $project->tags()->create([
                'name' => $tag,
            ]);
        }

        return redirect()
            ->route('list-portfolio')
            ->with('success', 'La réalisation a été ajoutée au portfolio avec succès.');
    }


    public function editPortfolio(PortfolioProject $project)
    {

        $project->load([('tags')]);
        return view('admin.portfolio.edit', compact('project'));
    }

    public function updatePortfolio(Request $request, PortfolioProject $project, PortfolioImageService $imageService)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'url' => ['required', 'url'],
            'is_visible' => ['boolean'],
            'authorization_pending' => ['boolean'],
            'tags' => ['required', 'array', 'min:1'],
            'tags.*' => ['required', 'string', 'max:50'],
        ]);

        $oldImage = $project->image;
        $image = $oldImage;

        if ($request->hasFile('image')) {
            $image = $imageService->store($request->file('image'));
        }

        $project->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'url' => $validated['url'],
            'image' => $image,
            'is_visible' => $request->boolean('is_visible'),
            'authorization_pending' => $request->boolean('authorization_pending'),
        ]);

        if ($request->hasFile('image')) {
            $imageService->delete($oldImage);
        }

        $project->tags()->delete();

        foreach ($validated['tags'] as $tag) {
            $project->tags()->create(['name' => $tag]);
        }

        return redirect()->route('edit-portfolio', $project->id)
            ->with('success', 'Portfolio updated successfully.');
    }

    public function deletePortfolio(PortfolioProject $project)
    {
        $image = $project->image;
        if ($image && file_exists(public_path($image))) {
            unlink(public_path($image));
        }
        $project->delete();
        return redirect()
            ->route('list-portfolio')
            ->with('success', 'Projet supprimé avec succès.');
    }
}
