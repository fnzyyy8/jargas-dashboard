<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Inertia\Inertia;

class ProjectControlPlanController extends Controller
{
    public function index()
    {

        $categories = Projects::whereNotNull('category')->distinct()->pluck('category');
        $project_names = Projects::select('id','project_name','category')->get();


        return Inertia::render('projectControl/PlanPage', [
            'page_title' => 'Project Control',
            'categories' => $categories,
            'projects' => $project_names,
        ]);
    }

    public function store()
    {

    }
}
