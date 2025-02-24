<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class Option extends Model
{
    /** @use HasFactory<\Database\Factories\OptionFactory> */
    use HasFactory;

    protected $fillable = [
        'question_id',
        'next_question_id',
        'image',
        'status',
    ];

    public function translation():HasOne
    {
        return $this->hasOne(OptionTranslation::class, 'option_id', 'id')->where('locale', App::getLocale());
    }
}
