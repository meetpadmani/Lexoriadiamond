<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Crm\DashboardController;
use App\Http\Controllers\Crm\LeadController;
use App\Http\Controllers\Crm\ClientController;
use App\Http\Controllers\Crm\ProjectController;
use App\Http\Controllers\Crm\QuotationController;
use App\Http\Controllers\Crm\InvoiceController;
use App\Http\Controllers\Crm\PaymentController;
use App\Http\Controllers\Crm\FileManagerController;
use App\Http\Controllers\Crm\NotificationController;
use App\Http\Controllers\Crm\WhatsAppController;
use App\Http\Controllers\Crm\CrmAuthController;

/*
|--------------------------------------------------------------------------
| CRM Routes
|--------------------------------------------------------------------------
| All routes are prefixed with /crm and named crm.*
|--------------------------------------------------------------------------
*/

// CRM Auth (uses same auth system, different redirect)
Route::get('/login', [CrmAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [CrmAuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [CrmAuthController::class, 'logout'])->name('logout');

// Protected CRM Routes
Route::middleware('crm')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Lead Management
    Route::prefix('leads')->name('leads.')->group(function () {
        Route::get('/', [LeadController::class, 'index'])->name('index');
        Route::get('/kanban', [LeadController::class, 'kanban'])->name('kanban');
        Route::get('/create', [LeadController::class, 'create'])->name('create');
        Route::post('/', [LeadController::class, 'store'])->name('store');
        Route::get('/{lead}', [LeadController::class, 'show'])->name('show');
        Route::get('/{lead}/edit', [LeadController::class, 'edit'])->name('edit');
        Route::put('/{lead}', [LeadController::class, 'update'])->name('update');
        Route::delete('/{lead}', [LeadController::class, 'destroy'])->name('destroy');
        Route::post('/{lead}/status', [LeadController::class, 'updateStatus'])->name('updateStatus');
        Route::post('/{lead}/convert', [LeadController::class, 'convert'])->name('convert');
        Route::post('/{lead}/activity', [LeadController::class, 'addActivity'])->name('addActivity');
    });

    // Client Management
    Route::prefix('clients')->name('clients.')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('index');
        Route::get('/create', [ClientController::class, 'create'])->name('create');
        Route::post('/', [ClientController::class, 'store'])->name('store');
        Route::get('/{client}', [ClientController::class, 'show'])->name('show');
        Route::get('/{client}/edit', [ClientController::class, 'edit'])->name('edit');
        Route::put('/{client}', [ClientController::class, 'update'])->name('update');
        Route::delete('/{client}', [ClientController::class, 'destroy'])->name('destroy');
        Route::post('/{client}/document', [ClientController::class, 'uploadDocument'])->name('uploadDocument');
        Route::delete('/{client}/document/{document}', [ClientController::class, 'deleteDocument'])->name('deleteDocument');
    });

    // Project Management
    Route::prefix('projects')->name('projects.')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::get('/create', [ProjectController::class, 'create'])->name('create');
        Route::post('/', [ProjectController::class, 'store'])->name('store');
        Route::get('/{project}', [ProjectController::class, 'show'])->name('show');
        Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('edit');
        Route::put('/{project}', [ProjectController::class, 'update'])->name('update');
        Route::delete('/{project}', [ProjectController::class, 'destroy'])->name('destroy');
        Route::post('/{project}/status', [ProjectController::class, 'updateStatus'])->name('updateStatus');
        Route::post('/{project}/file', [ProjectController::class, 'uploadFile'])->name('uploadFile');
        Route::delete('/{project}/file/{file}', [ProjectController::class, 'deleteFile'])->name('deleteFile');
        Route::post('/{project}/comment', [ProjectController::class, 'addComment'])->name('addComment');
    });

    // Quotations
    Route::prefix('quotations')->name('quotations.')->group(function () {
        Route::get('/', [QuotationController::class, 'index'])->name('index');
        Route::get('/create', [QuotationController::class, 'create'])->name('create');
        Route::post('/', [QuotationController::class, 'store'])->name('store');
        Route::get('/{quotation}', [QuotationController::class, 'show'])->name('show');
        Route::get('/{quotation}/edit', [QuotationController::class, 'edit'])->name('edit');
        Route::put('/{quotation}', [QuotationController::class, 'update'])->name('update');
        Route::delete('/{quotation}', [QuotationController::class, 'destroy'])->name('destroy');
        Route::get('/{quotation}/pdf', [QuotationController::class, 'pdf'])->name('pdf');
        Route::post('/{quotation}/send', [QuotationController::class, 'send'])->name('send');
    });

    // Invoices
    Route::prefix('invoices')->name('invoices.')->group(function () {
        Route::get('/', [InvoiceController::class, 'index'])->name('index');
        Route::get('/create', [InvoiceController::class, 'create'])->name('create');
        Route::post('/', [InvoiceController::class, 'store'])->name('store');
        Route::get('/{invoice}', [InvoiceController::class, 'show'])->name('show');
        Route::get('/{invoice}/edit', [InvoiceController::class, 'edit'])->name('edit');
        Route::put('/{invoice}', [InvoiceController::class, 'update'])->name('update');
        Route::delete('/{invoice}', [InvoiceController::class, 'destroy'])->name('destroy');
        Route::get('/{invoice}/pdf', [InvoiceController::class, 'pdf'])->name('pdf');
    });

    // Payments
    Route::prefix('payments')->name('payments.')->group(function () {
        Route::get('/', [PaymentController::class, 'index'])->name('index');
        Route::get('/create', [PaymentController::class, 'create'])->name('create');
        Route::post('/', [PaymentController::class, 'store'])->name('store');
        Route::get('/{payment}', [PaymentController::class, 'show'])->name('show');
        Route::delete('/{payment}', [PaymentController::class, 'destroy'])->name('destroy');
    });

    // File Manager
    Route::prefix('files')->name('files.')->group(function () {
        Route::get('/', [FileManagerController::class, 'index'])->name('index');
        Route::post('/upload', [FileManagerController::class, 'upload'])->name('upload');
        Route::get('/download/{file}', [FileManagerController::class, 'download'])->name('download');
        Route::delete('/{file}', [FileManagerController::class, 'destroy'])->name('destroy');
    });

    // Notifications
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::post('/{notification}/read', [NotificationController::class, 'markRead'])->name('read');
        Route::post('/read-all', [NotificationController::class, 'markAllRead'])->name('readAll');
        Route::get('/count', [NotificationController::class, 'unreadCount'])->name('count');
    });

    // WhatsApp
    Route::prefix('whatsapp')->name('whatsapp.')->group(function () {
        Route::get('/', [WhatsAppController::class, 'index'])->name('index');
        Route::get('/conversations', [WhatsAppController::class, 'conversations'])->name('conversations');
        Route::get('/conversation/{conversation}', [WhatsAppController::class, 'conversation'])->name('conversation');
        Route::post('/send', [WhatsAppController::class, 'send'])->name('send');
        Route::post('/webhook', [WhatsAppController::class, 'webhook'])->name('webhook');
    });
});
