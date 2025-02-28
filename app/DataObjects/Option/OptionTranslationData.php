<?php

namespace App\DataObjects\Option;

use Akbarali\DataObject\DataObjectBase;

/**
 * Author: Bekzod Raximov
 * Date: 22/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class OptionTranslationData extends DataObjectBase
{
    public string|null $title;
    public string|null $text;
    public string|null $imageTitle;
    public string $locale;
}
