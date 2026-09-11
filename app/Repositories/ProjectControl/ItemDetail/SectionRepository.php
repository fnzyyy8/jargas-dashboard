<?php

namespace App\Repositories\ProjectControl\ItemDetail;

use App\Models\ProjectControl\ItemDetail\Section;
use Illuminate\Support\Collection;

class SectionRepository
{
    public function __construct(
        protected Section $model
    )
    {
    }

    public function getAll(): Collection
    {
        return $this->model->newQuery()->get();
    }

    public function getById(int $id): Section
    {
        return $this->model->newQuery()->findOrFail($id);
    }

    public function create(array $data): Section
    {
        return $this->model
            ->newQuery()
            ->firstOrCreate($data);
    }

    public function update(Section $section, array $data): Section
    {
        $section->update($data);

        return $section->fresh();
    }

    public function delete(Section $section): bool
    {
        return (bool)$section->delete();
    }
}
