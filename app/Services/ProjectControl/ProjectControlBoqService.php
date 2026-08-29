<?php

namespace App\Services\ProjectControl;

use App\Models\Project\Projects;
use App\Models\ProjectControl\Boq;

class ProjectControlBoqService
{
    public function getProjectsCategories()
    {
        return Projects::whereNotNull('category')
            ->where('isMultipleArea', true)
            ->distinct()
            ->pluck('category', 'category')
            ->values();
    }

    public function getProjects(?string $category)
    {
        return Projects::select('id', 'project_name', 'category')
            ->where('isMultipleArea', true)
            ->when($category, function ($query, $category) {
                return $query->where('category', $category);
            })->get();
    }

    public function getBoqs()
    {
        return Boq::query()->join('projects', 'boqs.project_id', '=', 'projects.id')
            ->select(
                'projects.project_number as project_number',
                'projects.area as project_area',
                'projects.project_name as project_name',
                'boqs.id',
                'boqs.detailed_area',
            )->get();

    }

    public function create(array $data)
    {
        return Boq::query()->create($data);

    }

    public function delete(int $id)
    {
        return Boq::query()->find($id)->delete();
    }

}
