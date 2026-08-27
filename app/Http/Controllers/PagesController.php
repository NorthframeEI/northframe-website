<?php

namespace App\Http\Controllers;

use App\Models\PortfolioProject;
use App\Models\Template;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $projects = PortfolioProject::with('tags')->latest()->get();
        return view('pages.home', compact('projects'));
    }

    public function contact()
    {
        $projet = request()->query('projet');
        $template = request()->query('template');
        $templates = Template::where('is_active', true)
            ->orderBy('title')
            ->get(['id', 'title', 'slug']);
        return view('pages.contact', compact('projet', 'template', 'templates'));
    }

    public function template()
    {
        $templates = Template::where('is_active', true)
            ->orderBy('position')
            ->orderBy('title')
            ->get();

        return view('pages.template', compact('templates'));
    }

    public function detailTemplate(string $slug)
    {
        $template = Template::with([
            'benefits',
            'sections',
        ])
            ->where('is_active', true)
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.detail-template', compact('template'));
    }

    public function mentionsLegales()
    {
        return view('legal.mentions-legales');
    }

    public function politiqueConfidentialite()
    {
        return view('legal.politique-confidentialite');
    }

    public function cgv()
    {
        return view('legal.cgv');
    }
}
