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

    public function searchProducts(Request $request)
    {
        $makeId = $request->input('make_id');
        $modelId = $request->input('model_id');
        $yearId = $request->input('year_id');
        $variantId = $request->input('variant_id');

        if (!$makeId) {
            return $this->httpResponse->setError()->setMessage('Make is required');
        }

        try {
            $query = \Botble\Ecommerce\Models\Product::query()
                ->join('product_vehicle_fitments', 'ec_products.id', '=', 'product_vehicle_fitments.product_id')
                ->where('product_vehicle_fitments.make_id', $makeId);

            if ($modelId) {
                $query->where(function($q) use ($modelId) {
                    $q->where('product_vehicle_fitments.model_id', $modelId)
                      ->orWhereNull('product_vehicle_fitments.model_id');
                });
            }

            if ($yearId) {
                $query->where(function($q) use ($yearId) {
                    $q->where('product_vehicle_fitments.year_id', $yearId)
                      ->orWhereNull('product_vehicle_fitments.year_id');
                });
            }

            if ($variantId) {
                $query->where(function($q) use ($variantId) {
                    $q->where('product_vehicle_fitments.variant_id', $variantId)
                      ->orWhereNull('product_vehicle_fitments.variant_id');
                });
            }

            $products = $query->with(['categories', 'brand'])
                ->select('ec_products.*')
                ->distinct()
                ->where('ec_products.status', 'published')
                ->where('ec_products.is_variation', 0)
                ->limit(20)
                ->get();

            return $this->httpResponse->setData([
                'products' => $products,
                'total' => $products->count(),
                'search_params' => [
                    'make_id' => $makeId,
                    'model_id' => $modelId,
                    'year_id' => $yearId,
                    'variant_id' => $variantId,
                ]
            ]);
        } catch (\Exception $e) {
            return $this->httpResponse->setError()->setMessage('Failed to search products: ' . $e->getMessage());
        }
    }
}