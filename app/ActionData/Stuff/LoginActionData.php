<?php

namespace App\ActionData\Stuff;

use Akbarali\ActionData\ActionDataBase;

/**
 * Author: Bekzod Raximov
 * Date: 13/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class LoginActionData extends ActionDataBase
{
    public string $login;
    public string $password;

    protected array $rules = [
        "login" => "required|string|exists:stuffs,login",
        "password" => "required|string"
    ];

}
