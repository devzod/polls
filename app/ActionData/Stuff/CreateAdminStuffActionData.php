<?php

namespace App\ActionData\Stuff;

use Akbarali\ActionData\ActionDataBase;

/**
 * Author: Bekzod Raximov
 * Date: 15/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class CreateAdminStuffActionData extends ActionDataBase
{
    public string $name;
    public string $phone;
    public string $login;
    public string $password;

    protected array $rules = [
        "name" => "required|string",
        "phone" => "required|string|min:9",
        "login" => "required|string|min:4|unique:stuffs,login",
        "password" => "required|string|min:4",
    ];
}
