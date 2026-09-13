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

    public function findByPriceListAndItem(int $priceListId, int $itemDetailId): ?UnitPrice
    {
        return $this->model
            ->newQuery()
            ->where('price_list_id', $priceListId)
            ->where('item_detail_id', $itemDetailId)
            ->first();
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

    public function create(array $data): UnitPrice
    {
        return $this->model
            ->newQuery()
            ->create($data);
    }

    public function getByIds(array $ids): Collection
    {
        return $this->model
            ->newQuery()
            ->whereIn('id', $ids)
            ->with(['itemDetail', 'latestRecordPrice'])
            ->get();
    }

    public function update(UnitPrice $unitPrice, array $data): UnitPrice
    {
        $unitPrice->update($data);
        return $unitPrice->fresh();
    }

    public function delete(UnitPrice $unitPrice): bool
    {
        return (bool)$unitPrice->delete();
    }

}
