<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Models\Project\Projects;
use App\Models\ProjectControl\Boq;
use App\Services\Project\ProjectService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    public function __construct(
        protected ProjectService $service
    )
    {
    }

    public function index(): Response
    {
        $projects = $this->service->read();

        return Inertia::render('projects/ProjectPage', [
            'page_title' => 'Project',
            'projects' => $projects,

        ]);
    }

    public function store(StoreProjectRequest $request)
    {

        $this->service->create($request->validated());

        return redirect()->back()->with('success', 'Project created successfully');

    }

    public function update(UpdateProjectRequest $request, int $id)
    {

        $this->service->update($id, $request->validated());

        return redirect()->back()->with('success', 'Project updated successfully');
    }

    public function destroy($id)
    {
        $project = Projects::findOrFail($id);

        if ($project->boqs()->exists()) {
            return redirect()->back()->with('error', 'Terdapat BOQ pada Project');
        }

        $project->delete();

        return redirect()->back()->with('info', 'Success Delete Project');
    }
}
