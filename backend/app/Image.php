<?php

namespace App;

use App\DTO\SourceImageDTO;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;
use phpDocumentor\Reflection\Types\Static_;

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
 *
 * @see Image::scopeSourceModel($sourceImageDTO)
 * @method static Builder|self sourceModel($sourceImageDTO)
 *
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

    /**
     * @param Builder $query
     * @param SourceImageDTO $sourceImageDTO
     * @return mixed
     */
    public function scopeSourceModel(Builder $query, SourceImageDTO $sourceImageDTO) {
        return $query->whereSource($sourceImageDTO->getType())->whereSourceId($sourceImageDTO->getModelId());
    }
}
