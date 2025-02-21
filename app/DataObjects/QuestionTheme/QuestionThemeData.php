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
    public int $title_size;
    public string $title_color;
    public string $title_align;
    public string $title_font;
    public int $text_size;
    public string $text_color;
    public string $text_align;
    public string $text_font;
    public string $image_align;
    public string $image_size;
    public string $bg_color;
    public string $container_color;
    public string|null $border;
    public string|null $style;

}
