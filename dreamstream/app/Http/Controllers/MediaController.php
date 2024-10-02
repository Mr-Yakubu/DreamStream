<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::all();
        return view('media.index', compact('media'));
    }

    public function create()
    {
        return view('media.create');
    }

    public function store(Request $request)
    {
        Media::create($request->all());
        return redirect()->route('media.index');
    }

    public function show($id)
    {
        $media = Media::findOrFail($id);
        return view('media.show', compact('media'));
    }

    public function edit($id)
    {
        $media = Media::findOrFail($id);
        return view('media.edit', compact('media'));
    }

    public function update(Request $request, $id)
    {
        $media = Media::findOrFail($id);
        $media->update($request->all());
        return redirect()->route('media.index');
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        $media->delete();
        return redirect()->route('media.index');
    }
}
