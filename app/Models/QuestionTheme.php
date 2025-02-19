<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionTheme extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionThemeFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title_size',
        'title_color',
        'title_align',
        'title_font',
        'text_size',
        'text_color',
        'text_align',
        'text_font',
        'image_position',
        'image_size',
        'bg_color',
        'container_color',
        'container_shadow',
        'border',
        'style',
        'script',
    ];
}
