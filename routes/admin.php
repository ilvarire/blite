<?php

use App\Livewire\Admin\AddCouponCode;
use App\Livewire\Admin\AddEquipment;
use App\Livewire\Admin\AddFood;
use App\Livewire\Admin\AddGallery;
use App\Livewire\Admin\AddShippingRates;
use App\Livewire\Admin\Bookings;
use App\Livewire\Admin\Categories;
use App\Livewire\Admin\Counties;
use App\Livewire\Admin\CouponCodes;
use App\Livewire\Admin\Customers;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Equipments;
use App\Livewire\Admin\Food;
use App\Livewire\Admin\Galleries;
use App\Livewire\Admin\Orders;
use App\Livewire\Admin\Profile;
use App\Livewire\Admin\Reviews;
use App\Livewire\Admin\Settings;
use App\Livewire\Admin\ShippingRates;
use App\Livewire\Admin\Sizes;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin'], function () {
    Route::middleware(['auth', 'rolemanager:admin'])->group(function () {
        //dashboard
        Route::get('/dashboard', Dashboard::class)->name('admin.dashboard');

        //categories
        Route::get('/categories', Categories::class)->name('admin.categories');

        //counties
        Route::get('/counties', Counties::class)->name('admin.counties');

        //food
        Route::get('/food', Food::class)->name('admin.food');
        Route::get('/food/add', AddFood::class)->name('admin.food.add');
        Route::get('/reviews', Reviews::class)->name('admin.reviews');

        //sizes
        Route::get('/sizes', Sizes::class)->name('admin.sizes');

        //order
        Route::get('/orders', Orders::class)->name('admin.orders');

        //customers
        Route::get('/customers', Customers::class)->name('admin.customers');
        Route::get('/bookings', Bookings::class)->name('admin.bookings');

        //coupons & discount
        Route::get('/coupons', CouponCodes::class)->name('admin.coupons');
        Route::get('/coupon/add', AddCouponCode::class)->name('admin.coupon.add');

        //shipping rates
        Route::get('/rates', ShippingRates::class)->name('admin.rates');
        Route::get('/rates/add', AddShippingRates::class)->name('admin.rates.add');

        //Profile
        Route::get('/profile', Profile::class)->name('admin.profile');

        //Gallery
        Route::get('/galleries', Galleries::class)->name('admin.galleries');
        Route::get('/gallery/add', AddGallery::class)->name('admin.gallery.add');

        //Equipment
        Route::get('/equipments', Equipments::class)->name('admin.equipments');
        Route::get('/equipment/add', AddEquipment::class)->name('admin.equipment.add');

        //Settings
        Route::get('/settings', Settings::class)->name('admin.settings');
    });
});
