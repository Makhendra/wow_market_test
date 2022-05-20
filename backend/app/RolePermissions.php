<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\RolePermissions
 *
 * @property int $id
 * @property int $role_id
 * @property string|null $permissions
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
    //
}
