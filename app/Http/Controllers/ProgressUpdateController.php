<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ProgressUpdateController extends Controller
{
    public function page()
    {
        return Inertia::render('projectControl/ProgressUpdatePage', [
            "page_title" => 'Project Control',
        ]);
    }
}
