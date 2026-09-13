<?php

namespace App\Services\Engineering;

use App\Repositories\Engineering\RecordPriceRepository;
use App\Repositories\Engineering\UnitPriceRepository;
use App\Repositories\ProjectControl\ItemDetail\ItemDetailRepository;
use App\Repositories\ProjectControl\ItemDetail\SectionRepository;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;
use RuntimeException;

class UnitPriceService
{
    public function __construct(
        protected UnitPriceRepository   $unitPriceRepository,
        protected RecordPriceRepository $recordPriceRepository,
        protected ItemDetailRepository  $itemDetailRepository,
        protected SectionRepository     $sectionRepository,
    )
    {
    }

    public function getAllItemDetails(): Collection
    {
        return $this->sectionRepository->getTree();
    }

    public function getPriceByPriceListId(int $priceListId): Collection
    {
        return $this->unitPriceRepository->getByPriceListId($priceListId);
    }

    public function sync(int $priceListId, array $itemDetailIds): bool
    {
        try {
            return DB::transaction(function () use ($priceListId, $itemDetailIds) {

                $this->unitPriceRepository->deleteUnselectedItemDetails($priceListId, $itemDetailIds);

                foreach ($itemDetailIds as $itemDetailId) {
                    $this->unitPriceRepository->firstOrCreate($priceListId, $itemDetailId);
                }
                return true;
            });
        } catch (Throwable $e) {
            Log::error('Failed to sync batch: ', [
                'price_list_id' => $priceListId,
                'item_detail_ids' => $itemDetailIds,
                'message' => $e->getMessage(),
            ]);

            throw new RuntimeException('Failed to sync batch', previous: $e);
        }

    }
}
