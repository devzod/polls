<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'poll_id',
        'question_theme_id',
        'type',
        'image',
        'video',
        'bg_image',
        'status',
    ];
}
