<?php

namespace App\DataObjects\Regions;

use Akbarali\DataObject\DataObjectBase;
use Carbon\Carbon;

/**
 * Author: Bekzod Raximov
 * Date: 11/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class RegionLocaleData extends DataObjectBase
{
    public int $id;
    public string $name;
    public string $locale;
    public bool $status;
    public Carbon $created_at;
    public Carbon $updated_at;
}
