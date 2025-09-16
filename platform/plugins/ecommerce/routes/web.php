use Botble\Ecommerce\Http\Controllers\Vehicle\MakeController;
use Botble\Ecommerce\Http\Controllers\Vehicle\ModelController;
use Botble\Ecommerce\Http\Controllers\Vehicle\YearController;
use Botble\Ecommerce\Http\Controllers\Vehicle\VariantController;
use Botble\Ecommerce\Http\Controllers\Vehicle\AdminVehicleController;
use Botble\Base\Facades\BaseHelper;

Route::group([
    'prefix' => BaseHelper::getAdminPrefix() . '/vehicle',
    'as' => 'vehicle.',
    'middleware' => ['web', 'auth'],
], function () {
    Route::resource('makes', MakeController::class);
    Route::resource('models', ModelController::class);
    Route::resource('years', YearController::class);
    Route::resource('variants', VariantController::class);
});

// Admin AJAX Vehicle Routes
Route::group([
    'prefix' => BaseHelper::getAdminPrefix() . '/ajax/vehicle',
    'as' => 'admin.ajax.vehicle.',
    'middleware' => ['web', 'auth'],
], function () {
    Route::get('models', [AdminVehicleController::class, 'getModels'])->name('models');
    Route::get('years', [AdminVehicleController::class, 'getYears'])->name('years');
    Route::get('variants', [AdminVehicleController::class, 'getVariants'])->name('variants');
});
