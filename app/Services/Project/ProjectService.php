<?php

namespace App\Services\Project;

use App\Models\Project\Projects;
use Illuminate\Support\Collection;

class ProjectService
{
    public function read(): Collection
    {
        return Projects::latest()->get();
    }

    public function readById(int $id)
    {
        return Projects::query()->findOrFail($id);
    }

    public function create($data)
    {
        return Projects::query()->create($data);
    }

    public function update(int $id, array $data)
    {
        $project = Projects::query()->findOrFail($id);

        return $project->update($data);
    }

}
