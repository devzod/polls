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
class StuffApiData extends DataObjectBase
{
    public int $id;
    public string $name;
    public string $phone;
}
