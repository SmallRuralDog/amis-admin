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
}
