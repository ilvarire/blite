<?php

use App\Http\Controllers\AuthCustomerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


Route::view('/maintenance', 'pages.maintenance-page')
    ->middleware('notmaintenance')
    ->name('maintenance');

Route::middleware('maintenance')->controller(CustomerController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/cart', 'cart')->name('cart');
    Route::get('/food', 'food')->name('food');
    Route::get('/food/{slug}', 'foodDetails')->name('food.details');

    Route::get('/equipments', 'equipments')->name('equipments');
    Route::get('/equipment/{slug}', 'equipmentDetails')->name('equipment.details');

    //gallery
    Route::get('/galleries', 'galleries')->name('galleries');
    Route::get('/gallery/{slug}', 'galleryDetails')->name('gallery.details');

    //company
    Route::get('/policy', 'policy')->name('policy');
    Route::get('/about', 'about')->name('about');
    Route::get('/guide', 'guide')->name('guide');
});

Route::middleware(['auth', 'verified', 'rolemanager:customer', 'maintenance'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    //auth customer
    Route::controller(AuthCustomerController::class)->group(function () {
        Route::get('/checkout', 'checkout')->name('checkout');
        Route::get('/orders', 'orders')->name('orders');
        Route::get('/orders/{reference}', 'orderDetails')->name('order.details');
        Route::get('/pay/{reference}', 'pay')->name('pay');
        Route::get('/pay', 'payerror')->name('payerror');

        Route::get('/profile', 'profile')->name('profile');
    });

    // Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    // Volt::route('settings/password', 'settings.password')->name('settings.password');
    // Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
