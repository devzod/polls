<?php

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

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

    public function translation(): HasOne
    {
        return $this->hasOne(PollTranslation::class, 'poll_id', 'id')->where('locale', App::getLocale());
    }

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, PollQuestion::class, 'poll_id', 'question_id');
    }
}
