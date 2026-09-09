<?php

namespace App\Models\ProjectControl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plans extends Model
{
    use HasFactory;

    protected $table = 'plans';
    protected $fillable = [
        'boq_id',
        'customer_category',
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

    public function PlanDetail(): HasMany
    {
        return $this->hasMany(PlanDetail::class, 'plan_id');

    }
}
