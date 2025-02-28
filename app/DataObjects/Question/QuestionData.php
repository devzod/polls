<?php

namespace App\DataObjects\Question;

use Akbarali\DataObject\DataObjectBase;

/**
 * Author: Bekzod Raximov
 * Date: 21/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class QuestionData extends DataObjectBase
{
    public int $id;
    public int|null $question_theme_id;
    public string $type;
    public string|null $image;
    public string|null $bg_image;
    public bool $status;
    public QuestionTranslationData $translation;
}
