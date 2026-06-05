<?php

use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::get('/template', [PagesController::class, 'template'])->name('template');
Route::get('/detail-template', [PagesController::class, 'detailTemplate'])->name('detail-template');
