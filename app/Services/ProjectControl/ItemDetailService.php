<?php

namespace App\Services\ProjectControl;


use App\Models\ProjectControl\ItemDetail\ItemDetail;
use App\Repositories\ProjectControl\ItemDetail\CategoryRepository;
use App\Repositories\ProjectControl\ItemDetail\ItemDetailRepository;
use App\Repositories\ProjectControl\ItemDetail\SectionRepository;
use App\Repositories\ProjectControl\ItemDetail\SubCategoryRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RuntimeException;
use Throwable;

class ItemDetailService
{
    public function __construct(
        protected SectionRepository     $sectionRepository,
        protected CategoryRepository    $categoryRepository,
        protected SubCategoryRepository $subCategoryRepository,
        protected ItemDetailRepository  $itemDetailRepository,
    )
    {
    }

    public function getAll(): Collection
    {
        return $this->sectionRepository->getTree();
    }

    public function create(array $data): ItemDetail
    {
        try {
            return DB::transaction(function () use ($data) {

                // Section
                $section = $this->sectionRepository->create(
                    $data['section']
                );

                // Category
                $category = null;

                if (filled($data['category']['name'] ?? null)) {
                    $category = $this->categoryRepository->create([
                        'name' => $data['category']['name'],
                        'sort_order' => $data['category']['sort_order'] ?? 0,
                        'section_id' => $section->id,
                    ]);
                }

                // Sub Category
                $subCategory = null;

                if (
                    $category &&
                    filled($data['subCategory']['name'] ?? null)
                ) {
                    $subCategory = $this->subCategoryRepository->create([
                        'name' => $data['subCategory']['name'],
                        'sort_order' => $data['subCategory']['sort_order'] ?? 0,
                        'category_id' => $category->id,
                    ]);
                }

                // Item Detail
                return $this->itemDetailRepository->create([
                    'name' => $data['itemDetail']['name'],
                    'unit' => $data['itemDetail']['unit'],
                    'sort_order' => $data['itemDetail']['sort_order'],

                    'section_id' => $section->id,
                    'category_id' => $category?->id,
                    'sub_category_id' => $subCategory?->id,
                ]);
            });

        } catch (Throwable $e) {
            Log::error('Failed to create item detail', [
                'message' => $e->getMessage(),
                'data' => $data,
            ]);

            throw  $e;
        }
    }

    public function getItemDetailOptions()
    {
        return [
            'sections' => $this->sectionRepository->getOptions(),
            'categories' => $this->categoryRepository->getOptions(),
            'subCategories' => $this->subCategoryRepository->getOptions(),
        ];
    }
}
