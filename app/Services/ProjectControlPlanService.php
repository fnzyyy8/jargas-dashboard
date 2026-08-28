<?php

namespace App\Services;

use App\Models\ProjectControlPlan;
use App\Models\Projects;


class ProjectControlPlanService
{
    public function getPlanDetail(int $id)
    {
        return Projects::query()->findOrFail($id);

    }

}
