use Botble\Ecommerce\Http\Controllers\Vehicle\MakeController;
use Botble\Ecommerce\Http\Controllers\Vehicle\ModelController;
use Botble\Ecommerce\Http\Controllers\Vehicle\YearController;
use Botble\Ecommerce\Http\Controllers\Vehicle\VariantController;

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
