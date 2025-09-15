<?php

namespace Botble\Ecommerce\Http\Controllers\Vehicle;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Ecommerce\Models\Make;
use Illuminate\Http\Request;

class MakeController extends BaseController
{
    public function index()
    {
        $makes = Make::all();
        return view('plugins/ecommerce::vehicle.makes.index', compact('makes'));
    }

    public function create()
    {
        return view('plugins/ecommerce::vehicle.makes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:makes,slug',
        ]);

        Make::create($request->only('name', 'slug'));

        return redirect()->route('vehicle.makes.index')->with('success', 'Make created successfully!');
    }

    public function edit(Make $make)
    {
        return view('plugins/ecommerce::vehicle.makes.edit', compact('make'));
    }

    public function update(Request $request, Make $make)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:makes,slug,' . $make->id,
        ]);

        $make->update($request->only('name', 'slug'));

        return redirect()->route('vehicle.makes.index')->with('success', 'Make updated successfully!');
    }

    public function destroy(Make $make)
    {
        $make->delete();
        return redirect()->route('vehicle.makes.index')->with('success', 'Make deleted successfully!');
    }
}
