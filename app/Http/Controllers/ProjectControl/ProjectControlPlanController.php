<?php

namespace App\Http\Controllers\ProjectControl;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectControl\StoreProjectControlPlanRequest;
use App\Services\ProjectControl\ProjectControlPlanService;
use Inertia\Inertia;
use Inertia\Response;

class ProjectControlPlanController extends Controller
{
    public function __construct(protected ProjectControlPlanService $service)
    {
    }

    public function index(int $id): Response
    {
        $getProject = $this->service->getProjects($id);

        return Inertia::render('projectControl/PlanPage', [
            'page_title' => 'Plan',
            'project_detail' => $getProject['boq'],
            'plans' => $getProject['plans'],
        ]);
    }

    public function store(StoreProjectControlPlanRequest $request)
    {
        $data = $request->validated();
        $this->service->create($data);

        return redirect()->back()->with('success', 'Plan Created Successfully');

    }

    public function destroy(int $id)
    {
        $this->service->delete($id);

        return redirect()->back()->with('info', 'Plan Deleted Successfully');
    }

}
