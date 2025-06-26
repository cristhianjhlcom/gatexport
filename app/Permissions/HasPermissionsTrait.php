<?php

declare(strict_types=1);

namespace App\Permissions;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasPermissionsTrait
{
    public function givePermissionTo(...$permissions)
    {
        $permissions = $this->getAllPermissions(array_merge(...$permissions));

        // get permission models.
        if ($permissions === null) {
            return $this;
        }

        // save many.
        $this->permissions()->saveMany($permissions);

        return $this;
    }

    public function withdrawPermissionTo(...$permissions)
    {
        $permissions = $this->getAllPermissions(array_merge(...$permissions));

        $this->permissions()->detach($permissions);

        return $this;
    }

    public function refreshPermissions(...$permissions)
    {
        $this->permissions()->detach();

        return $this->givePermissionTo($permissions);
    }

    public function hasPermissionTo($permission): bool
    {
        // has permissions throught roles.
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles()->where('name', $role)->exists()) {
                return true;
            }
        }

        return false;
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    protected function hasPermission($permission)
    {
        return (bool) $this->permissions->where('name', $permission->name)->count();
    }

    protected function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('name', $permissions);
    }

    protected function hasPermissionThroughRole($permission): bool
    {
        foreach ($permission->roles as $role) {
            if ($this->roles()->where('name', $role->name)->exists()) {
                return true;
            }
        }

        return false;
    }
}
