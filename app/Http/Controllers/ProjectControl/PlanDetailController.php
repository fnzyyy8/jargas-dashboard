<?php

namespace App\Http\Controllers\ProjectControl;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectControl\PlanDetailRequest;
use App\Services\ProjectControl\PlanDetailService;
use Inertia\Inertia;

class PlanDetailController extends Controller
{
    public function __construct(protected PlanDetailService $service)
    {
    }

    public function index(int $planId, int $id)
    {
        $plans = $this->service->getPlan($id);
        $planDetail = $this->service->getPlanDetail($planId);


        return Inertia::render('projectControl/PlanDetailPage', [
            'page_title' => 'Plan Detail',
            'plans' => $plans,
            'planDetail' => $planDetail
        ]);

    }

    public function store(PlanDetailRequest $request)
    {
        $this->service->create($request->validated());

        redirect()->back()->with('success', 'Plan Detail created.');
    }
}
