<?php

namespace App\Services\ProjectControl;

use App\Models\Project\Projects;
use App\Models\ProjectControl\Boq;
use App\Models\ProjectControl\Plans;


class ProjectControlPlanService
{
    public function getProjectDetail(int $id)
    {
        return Boq::query()->select(['id', 'project_id', 'detailed_area'])->with([
            'project:id,project_number,project_name,area,client'
        ])->findOrFail($id);

    }

    public function getPlans(int $id)
    {
        return Plans::query()->where('boq_id', $id)->get();

    }

    public function create(array $data)
    {
        return Plans::query()->create($data);


    }

    public function delete(int $id)
    {
        return Plans::query()->find($id)->delete();

    }

}
