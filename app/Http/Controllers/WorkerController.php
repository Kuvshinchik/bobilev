<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function dashboard()
    {
        $totalWorkers = Worker::count();
        $vaccinatedCount = Worker::where('vakcina', true)->count();

        return view('worker.dashboard', compact('totalWorkers', 'vaccinatedCount'));
    }

    public function table()
    {
        $workers = Worker::all();
        return view('worker.table', compact('workers'));
    }

    public function analytics()
    {
        $statusSiteStats = Worker::selectRaw('statusSite, COUNT(*) as count')
            ->groupBy('statusSite')
            ->get();

        $statusVokzalStats = Worker::selectRaw('statusVokzal, COUNT(*) as count')
            ->groupBy('statusVokzal')
            ->get();

        return view('worker.analytics', compact('statusSiteStats', 'statusVokzalStats'));
    }
}