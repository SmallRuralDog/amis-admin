<?php

namespace SmallRuralDog\AmisAdmin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $table = 'admin_roles';


    public function __construct(array $attributes = [])
    {
        $connection = config('amis-admin.database.connection') ?: config('database.default');
        $this->setConnection($connection);
        $this->setTable(config('amis-admin.database.roles_table'));
        parent::__construct($attributes);
    }

    public function administrators(): BelongsToMany
    {
        $pivotTable = config('amis-admin.database.role_users_table');
        $relatedModel = config('amis-admin.database.users_model');
        return $this->belongsToMany($relatedModel, $pivotTable, 'role_id', 'user_id');
    }

    public function permissions(): BelongsToMany
    {
        $pivotTable = config('amis-admin.database.role_permissions_table');
        $relatedModel = config('amis-admin.database.permissions_model');
        return $this->belongsToMany($relatedModel, $pivotTable, 'role_id', 'permission_id');
    }

    public function menus(): BelongsToMany
    {
        $pivotTable = config('amis-admin.database.role_menu_table');
        $relatedModel = config('amis-admin.database.menu_model');
        return $this->belongsToMany($relatedModel, $pivotTable, 'role_id', 'menu_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $model->administrators()->detach();
            $model->permissions()->detach();
            $model->menus()->detach();
        });
    }
}
