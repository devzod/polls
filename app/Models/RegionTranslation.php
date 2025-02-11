<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegionTranslation extends Model
{
    protected $fillable = [
        'region_id',
        'locale',
        'name',
    ];
}
