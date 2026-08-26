<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectControlPlanRequest;
use App\Models\Projects;
use App\Services\ProjectControlPlanService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProjectControlPlanController extends Controller
{
    public function __construct(protected ProjectControlPlanService $service)
    {
    }

    public function index(Request $request): Response
    {
        $selectedCategory = $request->input('category');
        $selectedProject = $request->input('idProject');

        return Inertia::render('projectControl/PlanPage', [
            'page_title' => 'Project Control',
            'project_categories' => $this->service->getProjectCategoriesFilter(),
            'projects' => $this->service->getProjectName($selectedCategory),
            'plans' => $this->service->getPlansById($selectedProject ? (int)$selectedProject : null),
            'filters' => [
                'category' => $selectedCategory,
                'idProject' => $selectedProject,
            ]
        ]);
    }

    public function store(StoreProjectControlPlanRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()->back();
    }
}
