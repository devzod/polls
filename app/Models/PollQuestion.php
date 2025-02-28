<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PollQuestion extends Model
{
    protected $fillable = [
        'poll_id',
        'question_id',
    ];
}
