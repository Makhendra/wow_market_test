<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

/**
 * App\Image
 *
 * @property int $id
 * @property string $source
 * @property int $source_id
 * @property string $path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Image newModelQuery()
 * @method static Builder|Image newQuery()
 * @method static Builder|Image query()
 * @method static Builder|Image whereCreatedAt($value)
 * @method static Builder|Image whereId($value)
 * @method static Builder|Image wherePath($value)
 * @method static Builder|Image whereSource($value)
 * @method static Builder|Image whereSourceId($value)
 * @method static Builder|Image whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Image extends Model
{
    protected $guarded = [];

    /**
     * @return MorphTo
     */
    public function image(): MorphTo
    {
        return $this->morphTo();
    }
}
