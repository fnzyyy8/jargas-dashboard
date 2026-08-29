<?php

namespace App\Models\ProjectControl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plans extends Model
{
    protected $table = 'plans';
    protected $fillable = [
        'boq_id',
        'section',
        'category',
        'sub_category',
        'item_detail',
        'unit',
        'volume',
        'unit_price',
    ];

    public function boq(): BelongsTo
    {
        return $this->belongsTo(Boq::class, 'boq_id');
    }
}
