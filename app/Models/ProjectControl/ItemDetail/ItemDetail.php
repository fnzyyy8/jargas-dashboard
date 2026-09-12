<?php

namespace App\Models\ProjectControl\ItemDetail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $section_id
 * @property int|null $category_id
 * @property int|null $sub_category_id
 * @property string $name
 * @property string $unit
 * @property int $sort_order
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \App\Models\ProjectControl\ItemDetail\Category|null $category
 * @property-read \App\Models\ProjectControl\ItemDetail\Section $section
 * @property-read \App\Models\ProjectControl\ItemDetail\SubCategory|null $subCategory
 * @method static \Database\Factories\ProjectControl\ItemDetail\ItemDetailFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemDetail whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemDetail whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemDetail whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemDetail whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemDetail whereSubCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemDetail whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemDetail whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ItemDetail extends Model
{
    use HasFactory;

    protected $table = 'item_details';
    protected $fillable = [
        'section_id',
        'category_id',
        'sub_category_id',
        'name',
        'unit',
        'sort_order'
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

}
