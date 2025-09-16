<?php

use Illuminate\Support\Facades\Route;
use Botble\Base\Facades\AdminHelper;
use Botble\Ecommerce\Http\Controllers\Vehicle\MakeController;
use Botble\Ecommerce\Http\Controllers\Vehicle\ModelController;
use Botble\Ecommerce\Http\Controllers\Vehicle\YearController;
use Botble\Ecommerce\Http\Controllers\Vehicle\VariantController;
use Botble\Ecommerce\Http\Controllers\Vehicle\AdminVehicleController;

// Test route 
Route::get('admin/vehicle/test', function () {
    return 'Vehicle routes are working!';
});

AdminHelper::registerRoutes(function (): void {
    // Admin Vehicle Routes
    Route::group([
        'prefix' => 'vehicle',
        'as' => 'vehicle.',
    ], function () {
        Route::resource('makes', MakeController::class);
        Route::resource('models', ModelController::class);
        Route::resource('years', YearController::class);
        Route::resource('variants', VariantController::class);
    });

    // Admin AJAX Vehicle Routes
    Route::group([
        'prefix' => 'ajax/vehicle',
        'as' => 'admin.ajax.vehicle.',
    ], function () {
        Route::get('models', [AdminVehicleController::class, 'getModels'])->name('models');
        Route::get('years', [AdminVehicleController::class, 'getYears'])->name('years');
        Route::get('variants', [AdminVehicleController::class, 'getVariants'])->name('variants');
    });
});