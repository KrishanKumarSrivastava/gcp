<?php

namespace Botble\Ecommerce\Http\Controllers\Vehicle;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Ecommerce\Models\CarModel;
use Botble\Ecommerce\Models\CarYear;
use Botble\Ecommerce\Models\CarVariant;
use Illuminate\Http\Request;

class AdminVehicleController extends BaseController
{
    public function __construct(protected BaseHttpResponse $response)
    {
    }

    public function getModels(Request $request)
    {
        $makeId = $request->input('make_id');
        
        if (!$makeId) {
            return $this->response->setData([]);
        }

        $models = CarModel::where('make_id', $makeId)
            ->orderBy('name')
            ->get(['id', 'name']);

        return $this->response->setData($models);
    }

    public function getYears(Request $request)
    {
        $modelId = $request->input('model_id');
        
        if (!$modelId) {
            return $this->response->setData([]);
        }

        $years = CarYear::where('model_id', $modelId)
            ->orderBy('year', 'desc')
            ->get(['id', 'year']);

        return $this->response->setData($years);
    }

    public function getVariants(Request $request)
    {
        $yearId = $request->input('year_id');
        
        if (!$yearId) {
            return $this->response->setData([]);
        }

        $variants = CarVariant::where('year_id', $yearId)
            ->orderBy('name')
            ->get(['id', 'name']);

        return $this->response->setData($variants);
    }
}