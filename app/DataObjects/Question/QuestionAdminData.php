<?php

namespace App\DataObjects\Question;

use Akbarali\DataObject\DataObjectBase;
use Illuminate\Database\Eloquent\Collection;

/**
 * Author: Bekzod Raximov
 * Date: 26/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class QuestionAdminData extends DataObjectBase
{
    public int $id;
    public int|null $questionThemeId;
    public string $type;
    public string|null $image;
    public string|null $bgImage;
    public string|null $video;
    public bool $status;
    public Collection $translations;
    public Collection|null $options;
    public Collection|null $polls;
}
