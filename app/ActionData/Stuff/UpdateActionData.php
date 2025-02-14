<?php

namespace App\ActionData\Stuff;

use Akbarali\ActionData\ActionDataBase;

/**
 * Author: Bekzod Raximov
 * Date: 13/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class UpdateActionData extends ActionDataBase
{
    public string $name;
    public string|null $phone = null;

    protected array $rules = [
        "name" => "required|string",
        "phone" => "nullable|string",
    ];

}
