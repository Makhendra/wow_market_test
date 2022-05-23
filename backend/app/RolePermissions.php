<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\RolePermissions
 *
 * @property int $id
 * @property int $role_id
 * @property array $permissions_info
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|RolePermissions newModelQuery()
 * @method static Builder|RolePermissions newQuery()
 * @method static Builder|RolePermissions query()
 * @method static Builder|RolePermissions whereCreatedAt($value)
 * @method static Builder|RolePermissions whereId($value)
 * @method static Builder|RolePermissions wherePermissions($value)
 * @method static Builder|RolePermissions whereRoleId($value)
 * @method static Builder|RolePermissions whereUpdatedAt($value)
 * @mixin Eloquent
 */
class RolePermissions extends Model
{
    protected $fillable = ['role_id', 'permissions_info'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions_info' => 'array'
    ];

    const SECTION_USERS = 'users';
    const SECTION_ROLES = 'roles';
    const SECTION_PRODUCTS = 'products';
    const SECTION_PRICES = 'prices';
    const SECTION_STORES = 'stores';

    const SECTIONS = [
        self::SECTION_USERS,
        self::SECTION_ROLES,
        self::SECTION_PRODUCTS,
        self::SECTION_PRICES,
        self::SECTION_STORES,
    ];

    const ACTION_SHOW = 'show';
    const ACTION_CREATE = 'create';
    const ACTION_EDIT = 'edit';
    const ACTION_DELETE = 'delete';

    const ACTIONS = [
        self::ACTION_SHOW,
        self::ACTION_CREATE,
        self::ACTION_EDIT,
        self::ACTION_DELETE,
    ];

    /**
     * Get the phone record associated with the user.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
