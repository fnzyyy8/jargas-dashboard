<?php

namespace App\Models\ProjectControl\ItemDetail;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemDetail extends Model
{
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
