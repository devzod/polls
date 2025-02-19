<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionTranslation extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionTranslationFactory> */
    use HasFactory;

    protected $fillable = [
        'question_id',
        'title',
        'text',
        'image_title',
        'locale',
    ];
}
