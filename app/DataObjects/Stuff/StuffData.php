<?php

namespace App\DataObjects\Stuff;

use Akbarali\DataObject\DataObjectBase;
use Carbon\Carbon;

/**
 * Author: Bekzod Raximov
 * Date: 13/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class StuffData extends DataObjectBase
{
    public int $id;
    public string $name;
    public string $phone;
    public bool $status;
    public Carbon $created_at;
    public Carbon $updated_at;
}
