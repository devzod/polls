<?php
declare(strict_types=1);

namespace App\ActionData\User;

use Akbarali\ActionData\ActionDataBase;

/**
 * Author: Bekzod Raximov
 * Date: 08/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class LoginUserActionData extends ActionDataBase
{
    public string $username;
    public string $password;

    protected array $roles = [
        'username' => 'required|string|exists:users,username',
        'password' => 'required|string',
    ];
}
