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

    public function index(int $boqId, int $planId)
    {
        $plans = $this->service->getPlan($planId);
        $planDetail = $this->service->getPlanDetail($planId);


        return Inertia::render('projectControl/PlanDetail/PlanDetailPage', [
            'page_title' => 'Plan Detail',
            'plans' => $plans,
            'planDetails' => $planDetail
        ]);

    }

    public function create(PlanDetailRequest $request)
    {
        $this->service->create($request->validated());

        redirect()->back()->with('success', 'Plan Detail created.');
    }
}
