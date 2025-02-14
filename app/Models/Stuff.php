<?php

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Stuff extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\StuffFactory> */
    use HasFactory, HasApiTokens, EloquentFilterTrait;

    protected $fillable = [
        'name',
        'phone',
        'login',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
    ];
}
