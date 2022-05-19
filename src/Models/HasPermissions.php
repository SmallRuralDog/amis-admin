<?php

namespace SmallRuralDog\AmisAdmin\Models;

use Illuminate\Support\Collection;

trait HasPermissions
{
    public function allPermissions(): Collection
    {
        return $this->roles()->with('permissions')->get()->pluck('permissions')->flatten();
    }


    public function can($ability, $arguments = []): bool
    {
        if (empty($ability)) {
            return true;
        }

        if ($this->isAdministrator()) {
            return true;
        }



        return $this->roles->pluck('permissions')->flatten()->pluck('slug')->contains($ability);
    }

    public function cannot(string $permission): bool
    {
        return !$this->can($permission);
    }

    public function isAdministrator(): bool
    {
        return $this->isRole('administrator');
    }

    public function isRole(string $role): bool
    {
        return $this->roles->pluck('slug')->contains($role);
    }

    public function inRoles(array $roles = []): bool
    {
        return $this->roles->pluck('slug')->intersect($roles)->isNotEmpty();
    }

    public function visible(array $roles = []): bool
    {

        if ($this->isAdministrator()) {
            return true;
        }
        if (empty($roles)) {
            return false;
        }
        $roles = array_column($roles, 'slug');
        return $this->inRoles($roles);
    }
}
