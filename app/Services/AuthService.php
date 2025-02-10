<?php
declare(strict_types=1);

namespace App\Services;

use App\ActionData\User\LoginUserActionData;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Author: Bekzod Raximov
 * Date: 08/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class AuthService
{
    /**
     * @param LoginUserActionData $data
     * @return bool
     */
    public static function login(LoginUserActionData $data): bool
    {
        $user = User::query()->where('username', $data->username)->first();
        if (is_null($user) || !Hash::check($data->password, $user->password)) {
            return false;
        }
        Auth::login($user);
        return true;
    }
}
