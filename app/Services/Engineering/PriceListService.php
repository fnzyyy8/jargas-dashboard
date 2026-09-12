<?php

namespace App\Services\Engineering;

use App\Models\Engineering\PriceList\PriceList;
use App\Repositories\Engineering\PriceListRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;
use Throwable;
use RuntimeException;

class PriceListService
{
    public function __construct(
        protected PriceListRepository $repository,
    )
    {
    }

    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    public function create(array $data): PriceList
    {
        try {
            return DB::transaction(function () use ($data) {
                return $this->repository->create($data);
            });
        } catch (Throwable $e) {
            Log::error('Failed to create price list: ', [
                'message' => $e->getMessage(),
                'data' => $data
            ]);
            throw new RuntimeException(
                'Failed to create price list.',
                previous: $e,
            );
        }
    }

    public function update(int $id, array $data): PriceList
    {
        try {
            return DB::transaction(function () use ($id, $data) {
                $priceList = $this->repository->findById($id);
                return $this->repository->update($priceList, $data);
            });

        } catch (Throwable $e) {
            Log::error('Failed to update price list: ', [
                'price_list_id' => $id,
                'message' => $e->getMessage(),
                'data' => $data
            ]);
            throw new RuntimeException(
                'Failed to update price list.',
                previous: $e,
            );
        }
    }

    /**
     *
     *
     *
     */
    public function delete(int $id): void
    {
        try {

            $priceList = $this->repository
                ->findById($id);

            $this->repository
                ->delete($priceList);

        } catch (Throwable $e) {

            Log::warning('Failed to delete price list: ', [
                'price_list_id' => $id,
                'message' => $e->getMessage(),
            ]);
            throw new RuntimeException(
                'Failed to delete price list.',
                previous: $e,
            );
        }
    }
}
