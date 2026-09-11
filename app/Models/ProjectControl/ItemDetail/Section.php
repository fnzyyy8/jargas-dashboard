<?php

namespace App\Models\ProjectControl\ItemDetail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $table = 'sections';
    protected $fillable = [
        'name',
        'sort_order'
    ];

    public function categories()
    {
        return $this->hasMany(Category::class)
            ->orderBy('sort_order');
    }

    public function itemDetails()
    {
        return $this->hasMany(ItemDetail::class)
            ->orderBy('sort_order');
    }
}
