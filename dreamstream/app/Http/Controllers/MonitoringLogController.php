<?php

namespace App\Http\Controllers;

use App\Models\MonitoringLog;
use Illuminate\Http\Request;

class MonitoringLogController extends Controller
{
    public function index()
    {
        $logs = MonitoringLog::all();
        return view('logs.index', compact('logs'));
    }

    public function create()
    {
        return view('logs.create');
    }

    public function store(Request $request)
    {
        MonitoringLog::create($request->all());
        return redirect()->route('logs.index');
    }

    public function show($id)
    {
        $log = MonitoringLog::findOrFail($id);
        return view('logs.show', compact('log'));
    }

    public function edit($id)
    {
        $log = MonitoringLog::findOrFail($id);
        return view('logs.edit', compact('log'));
    }

    public function update(Request $request, $id)
    {
        $log = MonitoringLog::findOrFail($id);
        $log->update($request->all());
        return redirect()->route('logs.index');
    }

    public function destroy($id)
    {
        $log = MonitoringLog::findOrFail($id);
        $log->delete();
        return redirect()->route('logs.index');
    }
}
