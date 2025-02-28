<?php

namespace App\DataObjects\Option;

use Akbarali\DataObject\DataObjectBase;
use App\DataObjects\Question\QuestionData;
use Illuminate\Database\Eloquent\Collection;

/**
 * Author: Bekzod Raximov
 * Date: 22/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class OptionAdminData extends DataObjectBase
{
    public int $id;
    public int $questionId;
    public int|null $nextQuestionId;
    public string|null $image;
    public bool $status;
    public Collection $translations;
    public QuestionData|null $nextQuestion;
}
