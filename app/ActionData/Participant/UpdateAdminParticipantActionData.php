<?php

namespace App\ActionData\Participant;

use Akbarali\ActionData\ActionDataBase;

/**
 * Author: Bekzod Raximov
 * Date: 15/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class UpdateAdminParticipantActionData extends ActionDataBase
{
    public string $name;
    public string $phone;
    public string|null $birthday = null;
    public string|null $gender = null;
    public int $status = 0;

    protected array $rules = [
        'name' => 'required|string',
        'phone' => 'required|string|min:9',
        'birthday' => 'nullable|string',
        'gender' => 'nullable|string',
        'status' => 'nullable|integer',
    ];
}
