<?php

use Botble\Base\Facades\AdminHelper;
use Botble\Ecommerce\Http\Controllers\Vehicle\AdminVehicleController;
use Botble\Ecommerce\Http\Controllers\Vehicle\MakeController;
use Botble\Ecommerce\Http\Controllers\Vehicle\ModelController;
use Botble\Ecommerce\Http\Controllers\Vehicle\YearController;
use Botble\Ecommerce\Http\Controllers\Vehicle\VariantController;
use Illuminate\Support\Facades\Route;

AdminHelper::registerRoutes(function (): void {
    Route::group(['namespace' => 'Botble\Ecommerce\Http\Controllers\Vehicle', 'prefix' => 'vehicle'], function (): void {
        Route::resource('makes', MakeController::class);
        Route::resource('models', ModelController::class);
        Route::resource('years', YearController::class);
        Route::resource('variants', VariantController::class);
    });
    
    // Admin AJAX Vehicle Routes
    Route::group(['prefix' => 'ajax/vehicle', 'as' => 'admin.ajax.vehicle.'], function (): void {
        Route::get('models', [AdminVehicleController::class, 'getModels'])->name('models');
        Route::get('years', [AdminVehicleController::class, 'getYears'])->name('years');
        Route::get('variants', [AdminVehicleController::class, 'getVariants'])->name('variants');
    });
});