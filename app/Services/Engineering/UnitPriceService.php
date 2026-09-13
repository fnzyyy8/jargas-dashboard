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

    public function createBatch(array $payload): bool
    {
        try {
            return DB::transaction(function () use ($payload) {
                $priceListId = $payload['priceListId'];

                foreach ($payload['items'] as $item) {
                    $unitPrice = $this->unitPriceRepository->firstOrCreate(
                        $priceListId,
                        $item['item_detail_id'],
                        $item['isFreeIssueMaterial'] ?? false,
                    );
                    $this->unitPriceRepository->create([
                        'unit_price_id' => $unitPrice->id,
                        'price' => $item['price'],
                        'notes' => $item['notes'],
                    ]);
                }
                return true;
            });

        } catch (Throwable $e) {
            Log::error('Failed to create unit price batch: ',
                [
                    'message' => $e->getMessage(),
                    'payload' => $payload,
                ]);

            throw new RuntimeException('Failed to create unit price batch',
                previous: $e);
        }
    }
}
