<?php

namespace App\DataObjects\POS;

use Akbarali\DataObject\DataObjectBase;
use Carbon\Carbon;

/**
 * Author: Bekzod Raximov
 * Date: 12/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class PosData extends DataObjectBase
{
    public int $id;
    public int $region_id;
    public string $name;
    public string $phone;
    public string $address;
    public string $region_name;
    public float|null $latitude;
    public float|null $longitude;
    public int $status;
    public Carbon $created_at;
    public Carbon $updated_at;
}
