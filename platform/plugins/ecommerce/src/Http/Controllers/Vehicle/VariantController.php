<?php

namespace Botble\Ecommerce\Http\Controllers\Vehicle;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Ecommerce\Models\CarVariant;
use Botble\Ecommerce\Models\CarYear;
use Illuminate\Http\Request;

class VariantController extends BaseController
{
    public function index()
    {
        $variants = CarVariant::with('year.model.make')->get();
        return view('plugins/ecommerce::vehicle.variants.index', compact('variants'));
    }

    public function create()
    {
        $years = CarYear::with('model.make')->get()->pluck('year_with_model', 'id');
        return view('plugins/ecommerce::vehicle.variants.create', compact('years'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'year_id' => 'required|exists:years,id',
            'name' => 'required',
        ]);

        CarVariant::create($request->only('year_id', 'name'));

        return redirect()->route('vehicle.variants.index')->with('success', 'Variant created successfully!');
    }

    public function edit(CarVariant $variant)
    {
        $years = CarYear::with('model.make')->get()->pluck('year_with_model', 'id');
        return view('plugins/ecommerce::vehicle.variants.edit', compact('variant', 'years'));
    }

    public function update(Request $request, CarVariant $variant)
    {
        $request->validate([
            'year_id' => 'required|exists:years,id',
            'name' => 'required',
        ]);

        $variant->update($request->only('year_id', 'name'));

        return redirect()->route('vehicle.variants.index')->with('success', 'Variant updated successfully!');
    }

    public function destroy(CarVariant $variant)
    {
        $variant->delete();
        return redirect()->route('vehicle.variants.index')->with('success', 'Variant deleted successfully!');
    }
}