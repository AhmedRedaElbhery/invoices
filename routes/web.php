<?php

use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\InvoicesAttachmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});



Route::get('/invoices', [InvoicesController::class, 'index'])->name('invoices');
Route::get('/invoices_create', [InvoicesController::class, 'create'])->name('invoices.create');
Route::post('/invoices_store', [InvoicesController::class, 'store'])->name('invoices.store');
Route::get('/invoices_edit/{id}', [InvoicesController::class, 'edit'])->name('invoiceedit');
Route::post('/invoices_update', [InvoicesController::class, 'update'])->name('invoices.update');
Route::get('/invoices_destroy/{id}', [InvoicesController::class, 'destroy'])->name('invoice.destroy');
Route::get('/invoice_status/{id}', [InvoicesController::class, 'show'])->name('invoice.show');
Route::post('/update_status', [InvoicesController::class, 'updatestatus'])->name('updatestatus');


Route::get('/export_invoices', [InvoicesController::class, 'export'])->name('export_invoices');


Route::get('/paid_invoices', [InvoicesController::class, 'paid_invoices'])->name('paid_invoices');
Route::get('/unpaid_invoices', [InvoicesController::class, 'unpaid_invoices'])->name('unpaid_invoices');
Route::get('/paidpart_invoices', [InvoicesController::class, 'paidpart_invoices'])->name('paidpart_invoices');
Route::get('/invoice_archive/{id}', [InvoicesController::class, 'invoice_archive'])->name('invoice_archive');
Route::get('/archives', [InvoicesController::class, 'archives'])->name('archives');
Route::get('/print_invoice/{id}', [InvoicesController::class, 'print_invoice'])->name('print_invoice');
Route::get('/returntoinvoices/{id}', [InvoicesController::class, 'returntoinvoices'])->name('returntoinvoices');


Route::get('/invoices_details/{id}', [InvoicesDetailsController::class, 'edit'])->name('invoices.details');
Route::get('/openfile/{id}/{filename}', [InvoicesDetailsController::class, 'openfile'])->name('openfile');
Route::get('/downloadfile/{id}/{filename}', [InvoicesDetailsController::class, 'downloadfile'])->name('downloadfile');
Route::get('/deletefile/{id}/{filename}', [InvoicesDetailsController::class, 'deletefile'])->name('deletefile');


Route::post('/storeAttachment', [InvoicesAttachmentController::class, 'store'])->name('storeattachment');



Route::get('/section/{id}', [InvoicesController::class, 'getproducts']);

//group of sections
Route::get('/sections', [SectionsController::class, 'index'])->name('sections');
Route::post('/sections_store', [SectionsController::class, 'store'])->name('sections.store');
Route::post('/sections_edit', [SectionsController::class, 'edit'])->name('sections.edit');
Route::post('/sections_update', [SectionsController::class, 'update'])->name('sections.update');
Route::post('/sections_destroy', [SectionsController::class, 'destroy'])->name('sections.destroy');


//group of products
Route::get('/products', [ProductsController::class, 'index'])->name('products');
Route::post('/products_store', [ProductsController::class, 'store'])->name('products.store');
Route::post('/products_destroy', [ProductsController::class, 'destroy'])->name('products.destroy');
Route::post('/products_update', [ProductsController::class, 'update'])->name('products.update');


Route::get('/reports', [ReportController::class, 'index'])->name('reports');
Route::get('/reports_search', [ReportController::class, 'search'])->name('reports_search');



Route::get('/report_clint', [ReportController::class, 'report_clints'])->name('report_clint');
Route::get('/search_clients', [ReportController::class, 'search_clients'])->name('search_clients');


Route::group(['middelware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});


Route::get('/dashboard', function () {

    $chartjs = app()->chartjs
    ->name('barChartTest')
    ->type('bar')
    ->size(['width' => 400, 'height' => 200])
    ->labels(['Label x', 'Label y'])
    ->datasets([
        [
            "label" => "نسبه الفواتير الغير المدفوعه",
            'backgroundColor' => ['red'],
            'data' => [ number_format(\App\Models\Invoices::where('Value_Status', '2')->count() / \App\Models\Invoices::count() * 100 ,1),0]
        ],
        [
            "label" => "نسبه الفواتير مدفوعه",
            'backgroundColor' => ['green','green'],
            'data' => [0,number_format(\App\Models\Invoices::where('Value_Status', '0')->count() / \App\Models\Invoices::count() * 100 ,1)]
        ],
    ])
    ->options([]);


    $chartjs2 = app()->chartjs
        ->name('pieChartTest')
        ->type('pie')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['الفواتير المدفوعه', 'الفواتير الغير مدفوعه' , 'الفواتبر المدفوعه جزئيا'])
        ->datasets([
            [
                'backgroundColor' => ['green', 'red', 'yellow'],
            
                'data' => [number_format(\App\Models\Invoices::where('Value_Status', '0')->count() / \App\Models\Invoices::count() * 100) , number_format(\App\Models\Invoices::where('Value_Status', '2')->count() / \App\Models\Invoices::count() * 100) ,number_format(\App\Models\Invoices::where('Value_Status', '1')->count() / \App\Models\Invoices::count() * 100)]
            ]
        ])
        ->options([]);

    return view('dashboard', compact('chartjs' , 'chartjs2'));
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';


Route::get('/{page}', 'App\Http\Controllers\AdminController@index');
