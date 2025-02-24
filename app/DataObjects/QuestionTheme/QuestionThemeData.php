<?php

namespace App\DataObjects\QuestionTheme;

use Akbarali\DataObject\DataObjectBase;
use Illuminate\Database\Eloquent\Casts\Json;

/**
 * Author: Bekzod Raximov
 * Date: 20/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class QuestionThemeData extends DataObjectBase
{
    public int $id;
    public string $name;
    public int $titleSize;
    public string $titleColor;
    public string $titleAlign;
    public string $titleFont;
    public int $textSize;
    public string $textColor;
    public string $textAlign;
    public string $textFont;
    public string $imageAlign;
    public string $imageSize;
    public string|null $bgColor;
    public string|null $containerColor;
    public string|null $optionColor;
    public string|null $border;
    public string|null $style;

}
