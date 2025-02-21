<?php

namespace App\DataObjects\Question;

use Akbarali\DataObject\DataObjectBase;

/**
 * Author: Bekzod Raximov
 * Date: 21/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class QuestionLocaleData extends DataObjectBase
{
    public int $id;
    public int $poll_id;
    public int $question_theme_id;
    public string $type;
    public string|null $image;
    public string|null $bg_image;
    public bool $status;
    public string $title;
    public string|null $text;
    public string|null $image_title;
}
