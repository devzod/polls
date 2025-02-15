<?php

namespace App\DataObjects\Participant;

use Akbarali\DataObject\DataObjectBase;
use Carbon\Carbon;

/**
 * Author: Bekzod Raximov
 * Date: 15/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class ParticipantData extends DataObjectBase
{
    public int $id;
    public string $name;
    public string $phone;
    public string|null $birthday;
    public string|null $gender;
    public int $status;
    public Carbon $created_at;
    public Carbon $updated_at;

}
