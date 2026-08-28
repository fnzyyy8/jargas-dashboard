<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Boq extends Model
{
    protected $table = 'boqs';
    protected $fillable = ['project_id', 'detailed_area'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Projects::class, 'project_id', 'id');

    }
}
