<?php

namespace Botble\Ecommerce\Http\Controllers\Vehicle;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Ecommerce\Models\CarYear;
use Botble\Ecommerce\Models\CarModel;
use Illuminate\Http\Request;

class YearController extends BaseController
{
    public function index()
    {
        $years = CarYear::with('model.make')->get();
        return view('plugins/ecommerce::vehicle.years.index', compact('years'));
    }

    public function create()
    {
        $models = CarModel::with('make')->get()->pluck('name_with_make', 'id');
        return view('plugins/ecommerce::vehicle.years.create', compact('models'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'model_id' => 'required|exists:models,id',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
        ]);

        CarYear::create($request->only('model_id', 'year'));

        return redirect()->route('vehicle.years.index')->with('success', 'Year created successfully!');
    }

    public function edit(CarYear $year)
    {
        $models = CarModel::with('make')->get()->pluck('name_with_make', 'id');
        return view('plugins/ecommerce::vehicle.years.edit', compact('year', 'models'));
    }

    public function update(Request $request, CarYear $year)
    {
        $request->validate([
            'model_id' => 'required|exists:models,id',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
        ]);

        $year->update($request->only('model_id', 'year'));

        return redirect()->route('vehicle.years.index')->with('success', 'Year updated successfully!');
    }

    public function destroy(CarYear $year)
    {
        $year->delete();
        return redirect()->route('vehicle.years.index')->with('success', 'Year deleted successfully!');
    }
}