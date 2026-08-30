<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Models\Project\Projects;
use App\Models\ProjectControl\Boq;
use App\Services\Project\ProjectService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    public function __construct(
        protected ProjectService $projectService
    )
    {
    }

    public function index(): Response
    {
        $projects = $this->projectService->get();

        return Inertia::render('projects/ProjectPage', [
            'page_title' => 'Project',
            'projects' => $projects,

        ]);
    }

    public function store(StoreProjectRequest $request)
    {

        $project = Projects::create($request->validated());

        Boq::query()->create([
            'project_id' => $project->id,
            'detailed_area' => '-'
        ]);

        return redirect()->back();

    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'project_name' => 'required',
            'budget' => 'required',
            'area' => 'required',
            'client' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $project = Projects::findOrFail($id);
        $project->update($validated);

        return redirect()->back();
    }

    public function destroy($id): RedirectResponse
    {
        $project = Projects::findOrFail($id);

        if ($project->boqs()->exists()) {
            return redirect()->back()->with('error', 'Terdapat BOQ pada Project');
        }

        $project->delete();

        return redirect()->back();
    }
}
