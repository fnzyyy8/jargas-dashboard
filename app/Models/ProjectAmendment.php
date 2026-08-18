<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAmendment extends Model
{
    protected $table = 'project_amendments';
    protected $primaryKey = 'id';
    protected $fillable = [
        'project_id',
        'amendment_date',
        'amendment_description',
    ];
}
