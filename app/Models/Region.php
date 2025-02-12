<?php

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    use EloquentFilterTrait;

    protected $fillable = [
        'status'
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(RegionTranslation::class, 'region_id', 'id');
    }
}
