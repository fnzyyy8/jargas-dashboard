<?php

namespace App\Repositories\Engineering;

use App\Models\Engineering\PriceList\RecordPrice;
use Illuminate\Support\Collection;

class RecordPriceRepository
{

    public function __construct(
        protected RecordPrice $model
    )
    {
    }

    public function getByUnitPriceId(int $unitPriceId): Collection
    {
        return $this->model
            ->newQuery()
            ->where('unit_price_id', $unitPriceId)
            ->latest()
            ->get();
    }

    public function create(array $data): RecordPrice
    {
        return $this->model
            ->newQuery()
            ->create([
                'unit_price_id' => $data['unit_price_id'],
                'price' => $data['price'],
                'notes' => $data['notes'] ?? null,
            ]);
    }

    public function createBatch(array $records): bool
    {
        $timestamp = now();
        $payload = array_map(function ($record) use ($timestamp) {
            return [
                'unit_price_id' => $record['unit_price_id'],
                'price' => $record['price'],
                'notes' => $record['notes'],
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
        }, $records);

        return $this->model->newQuery()->insert($payload);
    }

    public function delete(RecordPrice $recordPrice): bool
    {
        return (bool)$recordPrice->delete();
    }

}
