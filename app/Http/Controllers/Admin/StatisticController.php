<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Statistic\StatisticResource;
use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{

    public function index()
    {
        $statistics = StatisticResource::collection(Statistic::all())->resolve();
        return inertia('Admin/Statistic/Index', compact('statistics'));
    }
}
