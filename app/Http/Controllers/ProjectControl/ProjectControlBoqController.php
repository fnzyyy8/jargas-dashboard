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
        $projectId = $request->input('projectId');

        $formData = $this->service->getFormData($getCategory);

        return Inertia::render('projectControl/BoqPage', [
            'page_title' => 'BOQ',
            'categories' => $formData['categories'],
            'projects' => $formData['projects'],
            'boqs' => $this->service->getBoqs(),
            'filters' => [
                'category' => $getCategory,
                'projectId' => $projectId
            ]
        ]);
    }

    public function store(StoreProjectControlBoqRequest $request)
    {
        $this->service->create($request->validated());
        return redirect()->back()->with('success', 'Success Create Boq');

    }

    public function destroy(int $id)
    {
        $this->service->delete($id);
        return redirect()->back()->with('info', 'Success Delete Boq');
    }
}
