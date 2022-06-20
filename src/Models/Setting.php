<?php

namespace SmallRuralDog\AmisAdmin\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'admin_settings';
    protected $guarded = [];

    protected $casts = [
        'value' => 'json',
    ];

    protected $primaryKey = "slug";

    public function __construct(array $attributes = [])
    {
        $connection = config('amis-admin.database.connection') ?: config('database.default');
        $this->setConnection($connection);
        $this->setTable(config('amis-admin.database.settings_table'));
        parent::__construct($attributes);
    }
}
