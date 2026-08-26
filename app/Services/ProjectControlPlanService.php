<?php

namespace App\Services;

use App\Models\ProjectControlPlan;
use App\Models\Projects;


class ProjectControlPlanService
{
    public function create(array $data): ProjectControlPlan
    {
        return ProjectControlPlan::create($data);
    }

    public function getProjectCategoriesFilter()
    {

        return Projects::whereNotNull('category')->distinct()->pluck('category');

    }

    public function getProjectName(?string $category)
    {
        return Projects::select('id', 'project_name')->when($category, function ($query, $category) {
            $query->where('category', $category);
        })->get();
    }

    public function getPlansById(?int $id)
    {
        if (!$id) {
            return [];
        } else {
            return ProjectControlPlan::where('project_id', $id)->get();
        }
    }

}
