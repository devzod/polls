<?php

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use EloquentFilterTrait;

    protected $fillable = [
        'name',
        'code',
        'icon',
        'status',
    ];
}
