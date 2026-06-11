<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::get('/template', [PagesController::class, 'template'])->name('template');
Route::get('/detail-template', [PagesController::class, 'detailTemplate'])->name('detail-template');


//Legal Pages
Route::get('/mentions-legales', [PagesController::class, 'mentionsLegales'])->name('mentions-legales');
Route::get('/politique-confidentialite', [PagesController::class, 'politiqueConfidentialite'])->name('politique-confidentialite');
Route::get('/cgv', [PagesController::class, 'cgv'])->name('cgv');

//Contact
Route::post('/contact', [ContactController::class, 'postForm'])
    ->name('contact.post');

//Admin
Route::domain(config('app.admin_domain'))
    ->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

        //Templates

        //create template
        Route::get('/create-template', [TemplateController::class, 'createTemplate'])->name('create-template');
        Route::post('/create-template', [TemplateController::class, 'storeTemplate'])
            ->name('store-template');

        //list templates
        Route::get('/templates', [TemplateController::class, 'listTemplates'])->name('list-templates');

        //delete route
        Route::delete('/templates/{template}', [TemplateController::class, 'deleteTemplate'])
            ->name('delete-template');
        //update route
        Route::get('/templates/{template}/edit', [TemplateController::class, 'editTemplate'])
            ->name('edit-template');
        Route::put('/templates/{template}', [TemplateController::class, 'updateTemplate'])
            ->name('update-template');
    });
