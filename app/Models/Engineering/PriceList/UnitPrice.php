<?php

namespace App\Models\Engineering\PriceList;

use App\Models\ProjectControl\ItemDetail\ItemDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UnitPrice extends Model
{
    protected $table = 'unit_prices';
    protected $fillable = [
        'price_list_id',
        'item_id',
        'isFreeIssueMaterial'
    ];

    public function recorded_price(): HasMany
    {
        return $this->hasMany(RecordPrice::class);
    }

    public function price_list(): BelongsTo
    {
        return $this->belongsTo(PriceList::class);
    }

    public function item_detail(): BelongsTo
    {
        $this->belongsTo(ItemDetail::class);
    }
}
