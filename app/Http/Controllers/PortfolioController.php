<?php

namespace App\Http\Controllers;

use App\Models\PortfolioProject;
use Illuminate\Http\Request;

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

    public function store(Request $request)
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

        $image = $request->file('image');

        $imageName = time() . '_' . $image->getClientOriginalName();

        $image->move(public_path('screen_portfolio'), $imageName);

        $project = PortfolioProject::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => 'screen_portfolio/' . $imageName,
            'url' => $validated['url'],
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
            ->with('success', 'La réalisation a été ajouté au portfolio avec succès.');
    }

    public function editPortfolio(PortfolioProject $project)
    {

        $project->load([('tags')]);
        return view('admin.portfolio.edit', compact('project'));
    }

    public function updatePortfolio(Request $request, PortfolioProject $project)
    {

        $validated = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'url' => ['required', 'url'],

            'is_visible' => ['boolean'],
            'authorization_pending' => ['boolean'],

            'tags' => ['required', 'array', 'min:1'],
            'tags.*' => ['required', 'string', 'max:50'],
        ]);

        $image = $project->image;
        if ($request->hasFile('image')) {
            //Delete Old Image
            if ($image && file_exists(public_path($image))) {
                unlink(public_path($image));
            }
            //upload new image
            $image = $request->file('image');

            $imageName = time() . '_' . $image->getClientOriginalName();

            $image->move(public_path('screen_portfolio'), $imageName);

            $image =   $image = 'screen_portfolio/' . $imageName;
        }

        $project->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'url' => $validated['url'],
            'image' => $image,
            'is_visible' => $request->boolean('is_visible'),
            'authorization_pending' => $request->boolean('authorization_pending'),
        ]);

        $project->tags()->delete();

        foreach ($validated['tags'] as $tag) {
            $project->tags()->create([
                'name' => $tag,
            ]);
        }
        return redirect()->route('edit-portfolio', $project->id)->with('success', 'Portfolio updated successfully.');
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
