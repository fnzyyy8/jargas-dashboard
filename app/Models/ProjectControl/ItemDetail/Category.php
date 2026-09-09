<?php

namespace App\Models\ProjectControl\ItemDetail;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'section_id',
        'name',
        'sort_order'
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function subCategories(): HasMany
    {
        return $this->hasMany(SubCategory::class)
            ->orderBy('sort_order');
    }

    public function itemDetails()
    {
        return $this->hasMany(ItemDetail::class)
            ->orderBy('sort_order');
    }
}
