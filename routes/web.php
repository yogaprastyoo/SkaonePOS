<?php

use App\Livewire\Pages\Cashier\CashierPage;
use App\Livewire\Pages\Order\OrderDetailPage;
use App\Livewire\Pages\Order\OrderPage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return redirect(route('filament.dashboard.auth.login'));
})->name('login');

Route::middleware(['auth'])->group(function () {

    Route::get('/cashier', CashierPage::class)
        ->name('cashier');

    Route::get('/invoices', OrderPage::class)
        ->name('invoices');

    Route::get('/invoice/{no_order}', OrderDetailPage::class)
        ->name('invoice.detail');
});
