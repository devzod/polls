<?php

namespace App\DataObjects\Question;

use Akbarali\DataObject\DataObjectBase;

/**
 * Author: Bekzod Raximov
 * Date: 21/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class QuestionTranslationData extends DataObjectBase
{
    public string $locale;
    public string $title;
    public string|null $text;
    public string|null $image_title;
}
