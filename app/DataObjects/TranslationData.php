<?php

namespace App\DataObjects;

use Akbarali\DataObject\DataObjectBase;

/**
 * Author: Bekzod Raximov
 * Date: 19/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class TranslationData extends DataObjectBase
{
    public string $title;
    public string $text;
    public string $locale;

}
