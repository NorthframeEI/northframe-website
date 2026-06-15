<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
     public function index()
    {
        $templates = Template::where('is_active', true)->get();

        return response()
            ->view('sitemap', compact('templates'))
            ->header('Content-Type', 'text/xml');
    }
}
