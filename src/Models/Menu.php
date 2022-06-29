<?php

namespace SmallRuralDog\AmisAdmin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Menu extends Model
{
    protected $table = "admin_menu";

    protected $guarded = [];

    protected $casts = [
        'params' => 'json',
        'active_menus' => 'json',
    ];

    public function __construct(array $attributes = [])
    {
        $connection = config('amis-admin.database.connection') ?: config('database.default');

        $this->setConnection($connection);

        $this->setTable(config('amis-admin.database.menu_table'));

        parent::__construct($attributes);
    }

    public function roles(): BelongsToMany
    {
        $pivotTable = config('amis-admin.database.role_menu_table');
        $relatedModel = config('amis-admin.database.roles_model');
        return $this->belongsToMany($relatedModel, $pivotTable, 'menu_id', 'role_id');
    }

    public function permissions(): BelongsToMany
    {
        $pivotTable = config('amis-admin.database.permission_menu_table');
        $relatedModel = config('amis-admin.database.permissions_model');
        return $this->belongsToMany($relatedModel, $pivotTable, 'menu_id', 'permission_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {
            $model->roles()->detach();
        });
    }
}
