<?php

namespace App\Services\Project;

use App\Models\Project\Projects;
use Illuminate\Support\Collection;

class ProjectService
{
    public function get(): Collection
    {
        return Projects::latest()->get();
    }

}
