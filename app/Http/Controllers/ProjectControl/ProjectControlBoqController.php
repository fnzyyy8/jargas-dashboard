<?php

namespace App\Http\Controllers\ProjectControl;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectControl\StoreProjectControlBoqRequest;
use App\Services\ProjectControl\ProjectControlBoqService;
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
            'page_title' => 'BOQ',
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
