<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionTranslation extends Model
{
    /** @use HasFactory<\Database\Factories\OptionTranslationFactory> */
    use HasFactory;

    protected $fillable = [
        'option_id',
        'title',
        'text',
        'image_title',
        'locale'
    ];
}
