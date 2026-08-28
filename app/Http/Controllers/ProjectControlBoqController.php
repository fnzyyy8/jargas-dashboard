<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectControlBoqRequest;
use App\Services\ProjectControlBoqService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectControlBoqController extends Controller
{
    public function __construct(protected ProjectControlBoqService $service)
    {
    }

    public function index(Request $request)
    {

        $getCategory = $request->input('category');

        return Inertia::render('projectControl/BoqPage', [
            'categories' => $this->service->getProjectsCategories(),
            'projects' => $this->service->getProjects($getCategory),
            'boqs' => $this->service->getBoqs(),
            'filters' => [
                'category' => $getCategory
            ]
        ]);
    }

    public function store(StoreProjectControlBoqRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()->back();

    }

    public function destroy(int $id)
    {
        $this->service->delete($id);

        return redirect()->back();
    }
}
