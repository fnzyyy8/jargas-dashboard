<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectControlPlan extends Model
{
    protected $table = 'project_control_plan';
    protected $fillable = [
        'project_id',
        'section',
        'category',
        'sub_category',
        'item_detail',
        'unit',
        'volume',
        'unit_price',
    ];

    public function project(): BelongsTo
    {
        return $this->project(Projects::class, 'project_id');
    }
}
