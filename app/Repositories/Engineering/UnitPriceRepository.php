<?php

namespace App\Repositories\Engineering;

use App\Models\Engineering\PriceList\UnitPrice;
use Illuminate\Support\Collection;

class UnitPriceRepository
{
    public function __construct(
        protected UnitPrice $model,
    )
    {
    }

    public function getByPriceListId(int $priceListId): Collection
    {
        return $this->model
            ->newQuery()
            ->where('price_list_id', $priceListId)
            ->with(['itemDetail.section', 'latestRecordPrice'])
            ->get();
    }


    public function findById(int $id): UnitPrice
    {
        return $this->model
            ->newQuery()
            ->with(['itemDetail.section', 'recordedPrices', 'latestRecordPrice'])
            ->findOrFail($id);
    }

    public function firstOrCreate(int $priceListId, int $itemDetailId, bool $isFreeIssueMaterial = false): UnitPrice
    {
        return $this->model
            ->newQuery()
            ->firstOrCreate([
                'price_list_id' => $priceListId,
                'item_detail_id' => $itemDetailId,
            ], [
                    'isFreeIssueMaterial' => $isFreeIssueMaterial,
                ]
            );
    }

    public function deleteUnselectedItemDetails(int $priceListId, array $itemDetailsIds): int
    {
        $query = $this->model
            ->newQuery()
            ->where('price_list_id', $priceListId);

        if (empty($itemDetailsIds)) {
            return $query->delete();
        }
        return $query
            ->whereNotIn('item_detail_id', $itemDetailsIds)
            ->delete();
    }
}
