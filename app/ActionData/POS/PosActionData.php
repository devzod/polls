<?php

namespace App\ActionData\POS;

use Akbarali\ActionData\ActionDataBase;

/**
 * Author: Bekzod Raximov
 * Date: 12/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class PosActionData extends ActionDataBase
{
    public string $name;
    public int $region_id;
    public string $phone;
    public string|null $address  = null;
    public float|null $latitude  = null;
    public float|null $longitude  = null;
    public int $status = 0;

    protected array $rules = [
        'name' => 'required|string',
        'region_id' => 'required|int|exists:regions,id',
        'phone' => 'required|string',
        'address' => 'nullable|string',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
        'status' => 'nullable|integer',
    ];
}
