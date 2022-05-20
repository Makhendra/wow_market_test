<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Role
 *
 * @property int $id
 * @property string $role
 *
 * @method static Builder|Role newModelQuery()
 * @method static Builder|Role newQuery()
 * @method static Builder|Role query()
 * @mixin Eloquent
 */
class Role extends Model
{
    const ADMIN = 'admin';
    const USER = 'user';

    public $timestamps = false;

    protected $table = 'user_roles';

    protected $fillable = ['role'];

    /**
     * Get the post that owns the comment.
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
