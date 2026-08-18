<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Models\Projects;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{

    public function __construct(
        protected ProjectService $projectService
    )
    {
    }

    public function index()
    {
        $projects = $this->projectService->get();

        return Inertia::render('projects/project', [
            'page_title' => 'Project',
            'projects' => $projects

        ]);
    }

    public function store(StoreProjectRequest $request)
    {

        Projects::create($request->validated());

        return redirect()->back()->with('success', 'Project Berhasil Ditambahkan');

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

    public function destroy($id)
    {
        $project = Projects::findOrFail($id);
        $project->delete();
        return redirect()->back();
    }
}
