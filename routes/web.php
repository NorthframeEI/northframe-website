<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::get('/template', [PagesController::class, 'template'])->name('template');
Route::get('/detail-template', [PagesController::class, 'detailTemplate'])->name('detail-template');


//Legal Pages
Route::get('/mentions-legales', [PagesController::class, 'mentionsLegales'])->name('mentions-legales');
Route::get('/politique-confidentialite', [PagesController::class, 'politiqueConfidentialite'])->name('politique-confidentialite');
Route::get('/cgv', [PagesController::class, 'cgv'])->name('cgv');


//Admin
Route::domain(config('app.admin_domain'))
    ->group(function () {
        Route::get('/', [AdminController::class , 'dashboard'])->name('dashboard');
        Route::get('/create-template', [AdminController::class , 'createTemplate'])->name('create-template');
    });
