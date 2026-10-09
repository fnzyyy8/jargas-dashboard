<?php

namespace App\Http\Controllers\ProjectControl;

use App\Http\Controllers\Controller;
use App\Http\Requests\Engineering\UnitPrice\SyncUnitPriceRequest;
use App\Http\Requests\ProjectControl\Plan\SyncPlanRequest;
use App\Http\Requests\ProjectControl\Plan\UpdatePlanRequest;
use App\Http\Resources\ProjectControl\Plan\PlanBoqInformationResource;
use App\Http\Resources\ProjectControl\Plan\PlanResource;
use App\Http\Resources\ProjectControl\Plan\PlanUpdateUnitPriceResource;
use App\Models\ProjectControl\Boq;
use App\Models\ProjectControl\Plan;
use App\Services\Engineering\UnitPriceService;
use App\Services\ProjectControl\PlanService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PlanController extends Controller
{
    public function __construct(
        protected PlanService      $service,
        protected UnitPriceService $unitPriceService
    )
    {
    }

    public function index(Boq $boq): Response
    {
        $boq = $boq->load('project.priceList');
        $plans = $this->service->getGroupByBoqId($boq->id);
        $planSections = PlanResource::collection($plans)->resolve();

        return Inertia::render('projectControl/Plan/PlanPage', [
            'boq' => (new PlanBoqInformationResource($boq))->resolve(),
            'planSections' => $planSections
        ]);
    }

    public function updatePlan(Boq $boq): Response
    {
        $boq = $boq->load('project.priceList');
        $plans = $this->service->getAllByBoqId($boq->id);
        $sections = $this->unitPriceService->getGroupByPriceListId($boq->project->price_list_id);


        return Inertia::render('projectControl/Plan/PlanUpdatePage', [
            'boq' => (new PlanBoqInformationResource($boq))->resolve(),
            'sections' => PlanUpdateUnitPriceResource::collection($sections)->resolve(),
            'plans' => $plans,
        ]);
    }

    public function sync(SyncPlanRequest $request, Boq $boq): RedirectResponse
    {
        $this->service->sync(
            $boq->id,
            $request->validated('unit_price_ids')
        );

        return redirect()->back()->with('success', 'Plan synchronized successfully.');

    }

    public function update(UpdatePlanRequest $request, Boq $boq, Plan $plan): RedirectResponse
    {
        $this->service->update(
            $plan,
            $request->validated()
        );
        return redirect()->route('plan.index', $boq)->with('success', 'Plan updated successfully.');
    }


}
