<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StatsController extends Controller
{
    public function index()
    {
        $totalVisits = Visit::count();
        $todayVisits = Visit::whereDate('created_at', Carbon::today())->count();
        $lastVisit = Visit::latest()->first();

        return view('stats', compact('totalVisits', 'todayVisits', 'lastVisit'));
    }
}
