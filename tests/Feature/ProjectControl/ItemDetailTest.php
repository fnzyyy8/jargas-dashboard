<?php

use App\Models\ProjectControl\ItemDetail\Category;
use App\Models\ProjectControl\ItemDetail\ItemDetail;
use App\Models\ProjectControl\ItemDetail\Section;
use App\Models\ProjectControl\ItemDetail\SubCategory;
use App\Services\ProjectControl\ItemDetailService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\{assertDatabaseCount};

uses(RefreshDatabase::class);

it('can create item details', function () {

    $section = Section::factory()->create([
        'name' => 'Section Name',
        'sort_order' => 1
    ]);

    $category = Category::factory()->create([
        'section_id' => $section->id,
        'name' => 'Category Name',
        'sort_order' => 1
    ]);

    $subCategory = SubCategory::factory()->create([
        'category_id' => $category->id,
        'name' => 'Sub Category Name',
        'sort_order' => 1
    ]);

    ItemDetail::factory()->create([
        'section_id' => $section->id,
        'category_id' => $category->id,
        'sub_category_id' => $subCategory->id,
        'name' => 'Item Detail Name',
        'sort_order' => 1,
        'unit' => 'Unit',
    ]);

    ItemDetail::factory()->create([
        'section_id' => $section->id,
        'category_id' => $category->id,
        'sub_category_id' => $subCategory->id,
        'name' => 'Item Detail Name 2',
        'sort_order' => 1,
        'unit' => 'Unit',
    ]);

    assertDatabaseCount('item_details', 2);


});

it('can create item detail hierarchy', function () {

    $service = app(ItemDetailService::class);

    $itemDetail = $service->create([
        'section' => [
            'name' => 'Section Name',
            'sort_order' => 1,
        ],

        'category' => [
            'name' => 'Category Name',
            'sort_order' => 1,
        ],

        'subCategory' => [
            'name' => 'Sub Category Name',
            'sort_order' => 1,
        ],

        'itemDetail' => [
            'name' => 'Item Detail Name',
            'sort_order' => 1,
            'unit' => 'Unit',
        ],
    ]);

    $service->create([
        'section' => [
            'name' => 'Section Name',
            'sort_order' => 1,
        ],

        'category' => [
            'name' => 'Category Name',
            'sort_order' => 1,
        ],

        'subCategory' => [
            'name' => 'Sub Category Name',
            'sort_order' => 1,
        ],

        'itemDetail' => [
            'name' => 'Item Detail Name 2',
            'sort_order' => 1,
            'unit' => 'Unit',
        ],
    ]);

    expect($itemDetail)
        ->toBeInstanceOf(ItemDetail::class);

    assertDatabaseCount('sections', 1);
    assertDatabaseCount('categories', 1);
    assertDatabaseCount('sub_categories', 1);
    assertDatabaseCount('item_details', 2);
});
