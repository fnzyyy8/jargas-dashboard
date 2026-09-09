<?php

namespace App\Services\ProjectControl;

use App\Models\ProjectControl\Boq;
use App\Models\ProjectControl\Plans;
use App\Services\Shared\DataTableQuery;
use Illuminate\Support\Facades\Log;

class PlanService
{
    public function getProjects(int $id)
    {
        $boq = Boq::query()->select(['id', 'project_id', 'detailed_area', 'isMultipleCustomer'])->with([
            'project:id,project_number,project_name,area,client',
        ])->findOrFail($id);

        $plans = Plans::query()->where('boq_id', $id)->latest()->get();

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

    public function getPlans(
        int     $boqId,
        ?string $search = null,
        int     $perPage = 5,
        int     $page = 1,
        string  $sortBy = 'create_at',
        string  $sortDirection = 'desc')
    {
        $query = Plans::query()->select([
            'id',
            'boq_id',
            'item_detail',
            'unit',
            'volume',
            'unit_price',
            'create_at',
        ])->where('boq_id', $boqId);

        return (new DataTableQuery($query))
            ->search($search, ['item_detail'])
            ->sort($sortBy, $sortDirection, ['create_at', 'item_detail'])
            ->paginate($perPage, $page);

    }


    public function create(array $data)
    {
        return Plans::query()->create($data);


    }

    public function delete(int $boqId, int $id)
    {

        $plan = Plans::query()
            ->where('boq_id', $boqId)
            ->findOrFail($id);
        return $plan->delete();

    }

}
