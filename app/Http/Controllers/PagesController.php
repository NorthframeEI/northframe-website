<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function contact()
    {
        $projet = request()->query('projet');
        $template = request()->query('template');
        return view('pages.contact', compact('projet','template'));
    }

     public function template()
    {
        return view('pages.template');
    }

    public function detailTemplate()
    {
        return view('pages.detail-template');
    }
}
