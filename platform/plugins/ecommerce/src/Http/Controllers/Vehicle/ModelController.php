<?php

namespace Botble\Ecommerce\Http\Controllers\Vehicle;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Ecommerce\Models\CarModel;
use Botble\Ecommerce\Models\Make;
use Illuminate\Http\Request;

class ModelController extends BaseController
{
    public function index()
    {
        $models = CarModel::with('make')->get();
        return view('plugins/ecommerce::vehicle.models.index', compact('models'));
    }

    public function create()
    {
        $makes = Make::pluck('name', 'id');
        return view('plugins/ecommerce::vehicle.models.create', compact('makes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'make_id' => 'required|exists:makes,id',
            'name' => 'required',
            'slug' => 'required|unique:models,slug',
        ]);

        CarModel::create($request->only('make_id', 'name', 'slug'));

        return redirect()->route('vehicle.models.index')->with('success', 'Model created successfully!');
    }

    public function edit(CarModel $model)
    {
        $makes = Make::pluck('name', 'id');
        return view('plugins/ecommerce::vehicle.models.edit', compact('model', 'makes'));
    }

    public function update(Request $request, CarModel $model)
    {
        $request->validate([
            'make_id' => 'required|exists:makes,id',
            'name' => 'required',
            'slug' => 'required|unique:models,slug,' . $model->id,
        ]);

        $model->update($request->only('make_id', 'name', 'slug'));

        return redirect()->route('vehicle.models.index')->with('success', 'Model updated successfully!');
    }

    public function destroy(CarModel $model)
    {
        $model->delete();
        return redirect()->route('vehicle.models.index')->with('success', 'Model deleted successfully!');
    }
}