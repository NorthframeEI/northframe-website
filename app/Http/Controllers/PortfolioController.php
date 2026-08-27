<?php

namespace App\Http\Controllers;

use App\Models\PortfolioProject;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
    $projects = PortfolioProject::with('tags')->get();
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

        foreach($validated['tags'] as $tag){
            $project->tags()->create([
                'name' => $tag,
            ]);
        }

        return redirect()
            ->route('list-portfolio')
            ->with('success', 'La réalisation a été ajouté au portfolio avec succès.');
    }
}
