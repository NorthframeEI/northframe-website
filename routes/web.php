<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DepositInvoiceController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\TemplateCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\QuoteItemController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\PortfolioController;
use Barryvdh\DomPDF\Facade\Pdf;


Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('/templates', [PagesController::class, 'template'])->name('template');
Route::get('/templates/{slug}', [PagesController::class, 'detailTemplate'])->name('detail-template');


//Legal Pages
Route::get('/mentions-legales', [PagesController::class, 'mentionsLegales'])->name('mentions-legales');
Route::get('/politique-confidentialite', [PagesController::class, 'politiqueConfidentialite'])->name('politique-confidentialite');
Route::get('/cgv', [PagesController::class, 'cgv'])->name('cgv');

//Contact

Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'postForm'])
    ->middleware('throttle:5,1')
    ->name('contact.post');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

//Admin
Route::domain(config('app.admin_domain'))
    ->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::middleware('auth')->group(function () {
            Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

            //Template Management
            Route::get('/create-template', [TemplateController::class, 'createTemplate'])->name('create-template'); // Show the form to create a new template
            Route::post('/create-template', [TemplateController::class, 'storeTemplate'])->name('store-template'); // Handle the form submission to store the new template
            Route::get('/templates', [TemplateController::class, 'listTemplates'])->name('list-templates'); // List all templates
            Route::delete('/templates/{template}', [TemplateController::class, 'deleteTemplate'])->name('delete-template'); // Delete a specific template
            Route::get('/templates/{template}/edit', [TemplateController::class, 'editTemplate'])->name('edit-template'); // Show the form to edit a specific template
            Route::put('/templates/{template}', [TemplateController::class, 'updateTemplate'])->name('update-template'); // Handle the form submission to update a specific template

            Route::get('/category', [TemplateCategoryController::class, 'listCategories'])->name('list-categories'); // List all categories
            Route::get('/category/create', [TemplateCategoryController::class, 'createCategory'])->name('create-category'); // Show the form to create a new category
            Route::post('/category', [TemplateCategoryController::class, 'storeCategory'])->name('store-category'); // Handle the form submission to store the new category
            Route::get('/category/{category}/edit', [TemplateCategoryController::class, 'editCategory'])->name('edit-category'); // Show the form to edit a specific category
            Route::put('/category/{category}', [TemplateCategoryController::class, 'updateCategory'])->name('update-category'); // Handle the form submission to update a specific category
            Route::delete('/category/{category}', [TemplateCategoryController::class, 'deleteCategory'])->name('delete-category'); // Delete a specific category    

            //Portfolio Management
            Route::get('/portfolio', [PortfolioController::class, 'index'])->name('list-portfolio');
            Route::get('/create-portfolio', [PortfolioController::class, 'create'])->name('create-portfolio');
            Route::post('/create-portfolio', [PortfolioController::class, 'store'])->name('store-portfolio');
            Route::get('/portfolio/{project}/edit', [PortfolioController::class, 'editPortfolio'])->name('edit-portfolio');
            Route::put('/portfolio/{project}', [PortfolioController::class, 'updatePortfolio'])->name('update-portfolio');
            Route::delete('/portfolio/{project}', [PortfolioController::class, 'deletePortfolio'])->name('delete-portfolio');

            //Quote Management
            Route::resource('quotes', QuoteController::class);
            Route::get('/quotes/create', [QuoteController::class, 'create'])->name('create-quote'); // Show the form to create a new quote
            Route::post('/quotes', [QuoteController::class, 'store'])->name('store-quote'); // Handle the form submission to store the new quote
            Route::get('/quotes', [QuoteController::class, 'index'])->name('list-quotes'); // List all quotes
            Route::get('/quotes/{quote}', [QuoteController::class, 'show'])->name('show-quote'); // Show a specific quote
            Route::get('/quotes/{quote}/edit', [QuoteController::class, 'edit'])->name('edit-quote'); // Show the form to edit a specific quote
            Route::put('/quotes/{quote}', [QuoteController::class, 'update'])->name('update-quote'); // Handle the form submission to update a specific quote
            Route::delete('/quotes/{quote}', [QuoteController::class, 'destroy'])->name('delete-quote'); // Delete a specific quote
            Route::get('/quotes/{quote}/preview', [QuoteController::class, 'preview'])
                ->name('quotes-preview'); // Preview a specific quote
            Route::post('/quotes/{quote}/generate-pdf', [QuoteController::class, 'generatePdf'])->name('quotes-generate-pdf'); // Generate PDF for a specific quote
            Route::get('/quotes/{quote}/pdf', [QuoteController::class, 'previewPdf'])
                ->name('quotes-preview-pdf'); // Preview PDF for a specific quote
            Route::post('/quotes/{quote}/sent', [QuoteController::class, 'sentQuote'])->name('quotes-sent'); // Mark a specific quote as sent
            Route::post('/quotes/{quote}/accept', [QuoteController::class, 'acceptQuote'])->name('quotes-accept'); // Mark a specific quote as accepted
            Route::post('/quotes/{quote}/reject', [QuoteController::class, 'rejectQuote'])->name('quotes-reject'); // Mark a specific quote as rejected

            //Quote Items
            Route::post('/quotes/{quote}/items', [QuoteItemController::class, 'store'])
                ->name('quotes-items-store');
            Route::delete('/quote-items/{item}', [QuoteItemController::class, 'destroy'])
                ->name('quote-items-delete');

            //Convert Quote to Invoice
            Route::post('/quotes/{quote}/convert', [QuoteController::class, 'convertToInvoice'])
                ->name('quotes-convert'); // Convert a specific quote to an invoice

            //Deposit Invoices Management
            Route::get('/deposit-invoices/{depositInvoice}', [DepositInvoiceController::class, 'show'])
                ->name('deposit-invoices-show');
            Route::get('/deposit-invoices', [DepositInvoiceController::class, 'index'])
                ->name('list-deposit-invoices');
            Route::get('/deposit-invoices/{depositInvoice}/preview', [DepositInvoiceController::class, 'preview'])
                ->name('deposit-invoices-preview');
            Route::post('/deposit-invoices/{depositInvoice}/generate-pdf', [DepositInvoiceController::class, 'generatePdf'])
                ->name('deposit-invoices-generate-pdf');
            Route::get('/deposit-invoices/{depositInvoice}/pdf', [DepositInvoiceController::class, 'previewPdf'])
                ->name('deposit-invoices-pdf'); // Preview PDF for a specific quote
            Route::post('/deposit-invoices/{depositInvoice}/send', [DepositInvoiceController::class, 'send'])
                ->name('deposit-invoices-send');

            //Invoice Management
            Route::get('/invoices', [InvoiceController::class, 'listInvoices'])->name('list-invoices'); // List all invoices
            Route::get('/invoices/{invoice}', [InvoiceController::class, 'showInvoice'])->name('invoices-show'); // Show a specific invoice
            Route::get('/invoices/{invoice}/pdf', [InvoiceController::class, 'previewInvoicePdf'])->name('invoices-preview-pdf'); // Preview PDF for a specific invoice
            Route::get('/invoices/{invoice}/preview', [InvoiceController::class, 'preview'])->name('invoices-preview'); // Preview a specific invoice
            Route::post('/invoices/{invoice}/generate-pdf', [InvoiceController::class, 'generatePdf'])->name('invoices-generate-pdf'); // Generate PDF for a specific invoice
            Route::get('/invoices/{invoice}/pdf', [InvoiceController::class, 'previewPdf'])->name('invoices-preview-pdf'); // Preview PDF for a specific invoice
            Route::post('/invoices/{invoice}/sent', [InvoiceController::class, 'sentInvoice'])->name('invoices-sent'); //Mark a specific invoice as sent
            Route::post('/invoices/{invoice}/cancelled', [InvoiceController::class, 'cancelledInvoice'])->name('invoices-cancelled');

            //Payement Management
            Route::post('/invoices/{invoice}/payment', [PaymentsController::class, 'store'])->name('invoice-payments-store');

            //Invoice paid
            Route::get('/invoices/{invoice}/paid-preview', [PaymentsController::class, 'paidPreview'])->name('invoices-paid-preview'); // Preview a specific invoice paid
            Route::post('/invoices/{invoice}/generate-paid-pdf', [PaymentsController::class, 'generatePaidInvoice'])->name('invoices-generate-paid-pdf'); // Generate PDF for a specific invoice paid
            Route::get('/invoices/{invoice}/paid-pdf', [PaymentsController::class, 'previewPaidPdf'])->name('invoices-preview-paid-pdf'); // Preview PDF for a specific invoice paid
            Route::post('/invoices/{invoice}/sent-paid-pdf', [PaymentsController::class, 'sentInvoicePaid'])->name('invoices-paid-sent'); //Mark a specific invoice as sent

            //Invoice cancelled
            Route::get('/invoices/{invoice}/cancelled-preview', [PaymentsController::class, 'cancelledPreview'])->name('invoices-cancelled-preview'); // Preview a specific invoice paid
            Route::post('/invoices/{invoice}/generate-cancelled-pdf', [PaymentsController::class, 'generateCancelledInvoice'])->name('invoices-generate-cancelled-pdf'); // Generate PDF for a specific invoice paid
            Route::get('/invoices/{invoice}/cancelled-pdf', [PaymentsController::class, 'previewCancelledPdf'])->name('invoices-preview-cancelled-pdf'); // Preview PDF for a specific invoice paid
            Route::post('/invoices/{invoice}/sent-cancelled-pdf', [PaymentsController::class, 'sentInvoiceCancelled'])->name('invoices-cancelled-sent'); //Mark a specific invoice as sent

        });
    });

//maintenance preview route for local environment
if (app()->environment('local')) {
    Route::view('/maintenance-preview', 'errors.503');
}
