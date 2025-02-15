<?php

namespace App\ActionData\Stuff;

use Akbarali\ActionData\ActionDataBase;

/**
 * Author: Bekzod Raximov
 * Date: 15/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class UpdateAdminStuffActionData extends ActionDataBase
{
    public string $name;
    public string $phone;
    public string $login;
    public string|null $password;
    public bool $status = false;

    protected array $rules = [
        "name" => "required|string",
        "phone" => "required|string|min:9",
        "login" => "required|string|min:4",
        "password" => "nullable|string|min:4",
        "status" => "nullable|boolean",
    ];
}
