<?php

namespace App\ActionData\Region;

use Akbarali\ActionData\ActionDataBase;

/**
 * Author: Bekzod Raximov
 * Date: 11/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class CreateRegionActionData extends ActionDataBase
{
    public array $name;
    public bool $active = false;

    protected array $rules = [
        "name" => "required|array",
        "name.*" => "required|string",
        "active" => "nullable|boolean"
    ];
}
