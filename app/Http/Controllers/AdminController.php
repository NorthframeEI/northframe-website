<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.page.dashboard');
    }

     public function createTemplate()
    {
        return view('admin.page.create-template');
    }
}
