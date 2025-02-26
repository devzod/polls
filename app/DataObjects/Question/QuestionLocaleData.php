<?php

namespace App\DataObjects\Question;

use Akbarali\DataObject\DataObjectBase;
use Illuminate\Database\Eloquent\Collection;

/**
 * Author: Bekzod Raximov
 * Date: 21/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class QuestionLocaleData extends DataObjectBase
{
    public int $id;
    public int|null $questionThemeId;
    public string $type;
    public string|null $image;
    public string|null $bgImage;
    public bool $status;
    public string|null $title;
    public string|null $text;
    public string|null $imageTitle;
    public Collection|null $options;
}
