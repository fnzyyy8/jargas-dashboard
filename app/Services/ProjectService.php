<?php

namespace App\Services;

use App\Models\Projects;
use Illuminate\Support\Collection;

class ProjectService
{
    public function get(): Collection
    {
        return Projects::latest()->get();
    }

}
