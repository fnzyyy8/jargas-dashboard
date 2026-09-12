<?php

namespace App\Models\ProjectControl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $boq_id
 * @property string $customer_category
 * @property string $section
 * @property string|null $category
 * @property string|null $sub_category
 * @property string $item_detail
 * @property string $unit
 * @property numeric $volume
 * @property numeric $unit_price
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProjectControl\PlanDetail> $PlanDetail
 * @property-read int|null $plan_detail_count
 * @property-read \App\Models\ProjectControl\Boq $boq
 * @method static \Database\Factories\ProjectControl\PlansFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plans newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plans newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plans query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plans whereBoqId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plans whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plans whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plans whereCustomerCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plans whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plans whereItemDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plans whereSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plans whereSubCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plans whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plans whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plans whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plans whereVolume($value)
 * @mixin \Eloquent
 */
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
