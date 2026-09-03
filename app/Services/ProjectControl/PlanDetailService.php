<?php

namespace App\Services\ProjectControl;

use App\Models\ProjectControl\PlanDetail;
use App\Models\ProjectControl\Plans;

class PlanDetailService
{
    public function getPlan(int $id)
    {
        return Plans::query()->select(['id', 'boq_id', 'customer_category', 'section', 'category', 'sub_category', 'item_detail', 'unit', 'unit_price', 'volume'])
            ->with(
                ['boq:id,project_id,detailed_area',
                    'boq.project:id,project_name,project_number,start_date,end_date,area,client'
                ])
            ->findOrFail($id);
    }

    public function getPlanDetail(int $id)
    {
        return PlanDetail::query()->select(['plan_date', 'plan_volume'])->where('plan_id', $id)->get();

    }

    public function create(array $data)
    {
        return PlanDetail::query()->create($data);
    }

}
