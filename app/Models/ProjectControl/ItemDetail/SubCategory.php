<?php

namespace App\Models\ProjectControl\ItemDetail;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubCategory extends Model
{
    protected $table = 'sub_categories';
    protected $fillable = [
        'category_id',
        'name',
        'sort_order'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function itemDetails()
    {
        return $this->hasMany(ItemDetail::class)
            ->orderBy('sort_order');
    }
}
