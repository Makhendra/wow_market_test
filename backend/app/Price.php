<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Price
 *
 * @property int $id
 * @property int $product_id
 * @property int|null $store_id
 * @property float $price
 * @property string $starts_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Price newModelQuery()
 * @method static Builder|Price newQuery()
 * @method static Builder|Price query()
 * @method static Builder|Price whereCreatedAt($value)
 * @method static Builder|Price whereId($value)
 * @method static Builder|Price wherePrice($value)
 * @method static Builder|Price whereProductId($value)
 * @method static Builder|Price whereStartsAt($value)
 * @method static Builder|Price whereStoreId($value)
 * @method static Builder|Price whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Price extends Model
{
    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
