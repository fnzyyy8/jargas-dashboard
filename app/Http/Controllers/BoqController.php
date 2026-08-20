<?php

namespace App\Http\Controllers;

use App\Services\ProjectService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BoqController extends Controller
{
    public function __construct(
        protected ProjectService $projectService,
    )
    {
    }

    public function page()
    {
        return Inertia::render('projectControl/BoqPage', [
            "page_title" => "Project Control",
            "projects" => $this->projectService->get()
        ]);
    }
}
