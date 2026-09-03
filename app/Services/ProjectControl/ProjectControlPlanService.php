<?php

namespace App\Services\ProjectControl;

use App\Models\ProjectControl\Boq;
use App\Models\ProjectControl\Plans;
use Illuminate\Database\Eloquent\Builder;


class ProjectControlPlanService
{
    public function getProjects(int $id)
    {
        $boq = Boq::query()->select(['id', 'project_id', 'detailed_area', 'isMultipleCustomer'])->with([
            'project:id,project_number,project_name,area,client',
        ])->findOrFail($id);

        $plans = Plans::query()->where('boq_id', $id)->get();

        $planQuery = Plans::query()->select('id', 'customer_category', 'section', 'category', 'sub_category')
            ->where('boq_id', $id);

        $customerCategory = (clone $planQuery)
            ->whereNotNull('customer_category')
            ->pluck('customer_category')
            ->unique()
            ->values();


        return [
            'boq' => $boq,
            'plans' => $plans,
            'planOption' => [
                'customerCategory' => $customerCategory,

            ]
        ];

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
