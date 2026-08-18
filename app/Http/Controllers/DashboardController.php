<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function show(DashboardService $dashboardService)
    {


        return Inertia::render('Dashboard', [
            'page_title' => 'Dashboard',
            'project_statuses' => $dashboardService->getProjectStatusStatistic()
        ]);

    }
}
