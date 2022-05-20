<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Store
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Store newModelQuery()
 * @method static Builder|Store newQuery()
 * @method static Builder|Store query()
 * @method static Builder|Store whereCreatedAt($value)
 * @method static Builder|Store whereDescription($value)
 * @method static Builder|Store whereId($value)
 * @method static Builder|Store whereName($value)
 * @method static Builder|Store whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Store extends Model
{
    const CHARS_LIMIT = 150;

    protected $fillable = ['name', 'description'];

    /**
     * @return string
     */
    public function getShortDescriptionAttribute(): string
    {
        if (strlen($this->description) > self::CHARS_LIMIT) {
            $new_text = substr($this->description, 0, self::CHARS_LIMIT);
            $new_text = trim($new_text);
            return $new_text . "...";
        } else {
            return $this->description ?? '';
        }
    }
}
