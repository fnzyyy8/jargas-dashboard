<?php

namespace App\Http\Controllers\ProjectControl;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectControl\StoreProjectControlPlanRequest;
use App\Services\ProjectControl\ProjectControlPlanService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProjectControlPlanController extends Controller
{
    public function __construct(protected ProjectControlPlanService $service)
    {
    }

    public function index(int $id): Response
    {

        return Inertia::render('projectControl/GetPlanDetail', [
            'page_title' => 'Plan',
            'project_detail' => $this->service->getProjectDetail($id),
            'plans' => $this->service->getPlans($id)
        ]);
    }

    public function store(StoreProjectControlPlanRequest $request)
    {
        $data = $request->validated();
        $this->service->create($data);

        return redirect()->back();

    }

    public function destroy(int $id)
    {
        $this->service->delete($id);

        return redirect()->back();
    }

}
