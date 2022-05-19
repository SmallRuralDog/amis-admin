<?php

namespace SmallRuralDog\AmisAdmin\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Storage;

class AdminUser extends Model implements AuthenticatableContract
{

    use Authenticatable,HasPermissions;

    protected $table = 'admin_users';

    protected $hidden = ['password'];

    public function __construct(array $attributes = [])
    {
        $connection = config('amis-admin.database.connection') ?: config('database.default');
        $this->setConnection($connection);
        $this->setTable(config('amis-admin.database.users_table'));
        parent::__construct($attributes);
    }

    public function getAvatarAttribute($avatar): string
    {
        if (url()->isValidUrl($avatar)) {
            return $avatar;
        }
        $disk = config('amis-admin.upload.disk');
        if ($avatar && array_key_exists($disk, config('filesystems.disks'))) {
            return Storage::disk(config('amis-admin.upload.disk'))->url($avatar);
        }
        $default = config('amis-admin.default_avatar');
        return admin_asset($default);
    }

    public function roles(): BelongsToMany
    {
        $pivotTable = config('amis-admin.database.role_users_table');
        $relatedModel = config('amis-admin.database.roles_model');
        return $this->belongsToMany($relatedModel, $pivotTable, 'user_id', 'role_id');
    }

    public function permissions(): BelongsToMany
    {
        $pivotTable = config('amis-admin.database.user_permissions_table');
        $relatedModel = config('amis-admin.database.permissions_model');
        return $this->belongsToMany($relatedModel, $pivotTable, 'user_id', 'permission_id');
    }

    protected static function boot(): void
    {
        parent::boot();
        static::deleting(function ($model) {
            $model->roles()->detach();
            //$model->permissions()->detach();
        });
    }
}
