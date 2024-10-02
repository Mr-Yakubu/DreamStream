<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function index()
    {
        $recommendations = Recommendation::all();
        return view('recommendations.index', compact('recommendations'));
    }

    public function create()
    {
        return view('recommendations.create');
    }

    public function store(Request $request)
    {
        Recommendation::create($request->all());
        return redirect()->route('recommendations.index');
    }

    public function show($id)
    {
        $recommendation = Recommendation::findOrFail($id);
        return view('recommendations.show', compact('recommendation'));
    }

    public function edit($id)
    {
        $recommendation = Recommendation::findOrFail($id);
        return view('recommendations.edit', compact('recommendation'));
    }

    public function update(Request $request, $id)
    {
        $recommendation = Recommendation::findOrFail($id);
        $recommendation->update($request->all());
        return redirect()->route('recommendations.index');
    }

    public function destroy($id)
    {
        $recommendation = Recommendation::findOrFail($id);
        $recommendation->delete();
        return redirect()->route('recommendations.index');
    }
}
