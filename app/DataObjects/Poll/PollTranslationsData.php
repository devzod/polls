<?php

namespace App\DataObjects\Poll;

use Akbarali\DataObject\DataObjectBase;
use Carbon\Carbon;

/**
 * Author: Bekzod Raximov
 * Date: 12/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class PollTranslationsData extends DataObjectBase
{
    public int $id;
    public int $type;
    public array $translations;
    public bool $status;
    public Carbon $created_at;
    public Carbon $updated_at;
}
