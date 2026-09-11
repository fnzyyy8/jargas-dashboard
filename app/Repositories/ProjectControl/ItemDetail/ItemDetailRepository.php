<?php

namespace App\Repositories\ProjectControl\ItemDetail;

use App\Models\ProjectControl\ItemDetail\ItemDetail;
use Illuminate\Support\Collection;

class ItemDetailRepository
{
    public function __construct(
        protected ItemDetail $model
    )
    {
    }

    public function getAll(): Collection
    {
        return $this->model
            ->newQuery()
            ->with([
                'subCategory:id,category_id,name,sort_order',
                'subCategory.category:id,section_id,name,sort_order',
                'subCategory.category.section:id,name,sort_order',
            ])
            ->get();
    }

    public function findById(int $id): ItemDetail
    {
        return $this->model->newQuery()->findOrFail($id);
    }

    public function create(array $data): ItemDetail
    {
        return $this->model->newQuery()->create($data);
    }

    public function update(ItemDetail $itemDetail, array $data): ItemDetail
    {
        $itemDetail->update($data);

        return $itemDetail->fresh();
    }

    public function delete(ItemDetail $itemDetail): bool
    {
        return (bool)$itemDetail->delete();
    }

}
