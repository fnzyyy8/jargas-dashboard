<?php

namespace App\Http\Controllers\ProjectControl;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectControl\StoreProjectControlPlanRequest;
use App\Http\Requests\Shared\DataTableRequest;
use App\Services\ProjectControl\PlanService;
use Inertia\Inertia;
use Inertia\Response;

class PlanController extends Controller
{
    public function __construct(protected PlanService $service)
    {
    }

    public function index(DataTableRequest $request, int $id): Response
    {
        $getProject = $this->service->getProjects($id);

//        $plans = $this->service->getPlans(
//            boqId: $id,
//            search: $request->search(),
//            perPage: $request->perPage(),
//            page: $request->page(),
//            sortBy: $request->sortBy(),
//            sortDirection: $request->sortDirection(),
//        );

        return Inertia::render('projectControl/Plan/PlanPage', [
            'boq' => $getProject['boq'],
            'plans' => $getProject['plans'],
        ]);
    }


    public function create(StoreProjectControlPlanRequest $request)
    {
        $data = $request->validated();
        $this->service->create($data);

        return redirect()->back()->with('success', 'Plan Created Successfully');

    }

    public function delete(int $boqId, int $id)
    {
        $this->service->delete($boqId, $id);
        return redirect()->route('plan.index', ['boqId' => $boqId])->with('success', 'Plan Deleted Successfully');
    }

}
