<?php

namespace App\Http\Controllers;

use App\Models\ParentalControl;
use Illuminate\Http\Request;

class ParentalControlController extends Controller
{
    public function index()
    {
        $controls = ParentalControl::all();
        return view('parental-controls.index', compact('controls'));
    }

    public function create()
    {
        return view('parental-controls.create');
    }

    public function store(Request $request)
    {
        ParentalControl::create($request->all());
        return redirect()->route('parental-controls.index');
    }

    public function show($id)
    {
        $control = ParentalControl::findOrFail($id);
        return view('parental-controls.show', compact('control'));
    }

    public function edit($id)
    {
        $control = ParentalControl::findOrFail($id);
        return view('parental-controls.edit', compact('control'));
    }

    public function update(Request $request, $id)
    {
        $control = ParentalControl::findOrFail($id);
        $control->update($request->all());
        return redirect()->route('parental-controls.index');
    }

    public function destroy($id)
    {
        $control = ParentalControl::findOrFail($id);
        $control->delete();
        return redirect()->route('parental-controls.index');
    }
}
