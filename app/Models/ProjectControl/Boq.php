<?php

namespace App\Models\ProjectControl;

use App\Models\Project\Projects;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Boq extends Model
{
    protected $table = 'boqs';
    protected $fillable = ['project_id', 'detailed_area'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Projects::class, 'project_id', 'id');

    }

    public function plans(): HasMany
    {
        return $this->hasMany(Plans::class, 'boq_id', 'id');
    }
}
