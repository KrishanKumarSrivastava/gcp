<?php

namespace Theme\Martfury\Http\Controllers;

use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Ecommerce\Models\Make;
use Botble\Ecommerce\Models\CarModel;
use Botble\Ecommerce\Models\CarYear;
use Botble\Ecommerce\Models\CarVariant;
use Botble\Theme\Http\Controllers\PublicController;
use Illuminate\Http\Request;

class CarSearchController extends PublicController
{
    public function __construct(protected BaseHttpResponse $httpResponse)
    {
        $this->middleware(function ($request, $next) {
            if (! $request->ajax()) {
                return $this->httpResponse->setNextUrl(route('public.index'));
            }

            return $next($request);
        });
    }

    public function getModels(Request $request)
    {
        $makeId = $request->input('make_id');
        
        if (!$makeId) {
            return $this->httpResponse->setData([]);
        }

        try {
            $models = CarModel::where('make_id', $makeId)
                ->orderBy('name')
                ->get(['id', 'name']);

            return $this->httpResponse->setData($models);
        } catch (\Exception $e) {
            return $this->httpResponse->setError()->setMessage('Failed to load models');
        }
    }

    public function getYears(Request $request)
    {
        $modelId = $request->input('model_id');
        
        if (!$modelId) {
            return $this->httpResponse->setData([]);
        }

        try {
            $years = CarYear::where('model_id', $modelId)
                ->orderBy('year', 'desc')
                ->get(['id', 'year']);

            return $this->httpResponse->setData($years);
        } catch (\Exception $e) {
            return $this->httpResponse->setError()->setMessage('Failed to load years');
        }
    }

    public function getVariants(Request $request)
    {
        $yearId = $request->input('year_id');
        
        if (!$yearId) {
            return $this->httpResponse->setData([]);
        }

        try {
            $variants = CarVariant::where('year_id', $yearId)
                ->orderBy('name')
                ->get(['id', 'name']);

            return $this->httpResponse->setData($variants);
        } catch (\Exception $e) {
            return $this->httpResponse->setError()->setMessage('Failed to load modifications');
        }
    }
}