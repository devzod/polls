<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PollTranslation extends Model
{
    protected $fillable = [
        'poll_id',
        'locale',
        'title',
        'text',
    ];
}
