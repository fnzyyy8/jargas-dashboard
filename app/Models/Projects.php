<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{

    protected $table = 'projects';
    protected $fillable = [
        'project_name',
        'project_code',
        'project_number',
        'category',
        'area',
        'client',
        'start_date',
        'end_date',
        'budget',
        'status',
    ];
}
