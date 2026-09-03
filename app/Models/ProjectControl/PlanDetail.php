<?php

namespace App\Models\ProjectControl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanDetail extends Model
{
    protected $table = 'plan_details';
    protected $fillable = [
        'plan_id',
        'plan_date',
        'plan_volume',
    ];

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plans::class, 'plan_id', 'id');
    }
}
