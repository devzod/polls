<?php

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Poll extends Model
{
    use SoftDeletes, EloquentFilterTrait;

    protected $fillable = [
        'type',
        'status',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(PollTranslation::class, 'poll_id', 'id');
    }
}
