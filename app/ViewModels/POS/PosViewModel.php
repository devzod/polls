<?php

namespace App\ViewModels\POS;

use Akbarali\ViewModel\BaseViewModel;
use App\Models\Pos;
use Carbon\Carbon;

/**
 * Author: Bekzod Raximov
 * Date: 11/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class PosViewModel extends BaseViewModel
{
    public int $id;
    public int $region_id;
    public string $name;
    public string $phone;
    public string $address;
    public string $region_name;
    public float|null $latitude;
    public float|null $longitude;
    public int $status;
    public Carbon|string $created_at;
    public Carbon|string $updated_at;
    public string $active_class = "";
    public string $active_text = "";


    protected function populate()
    {
        $this->created_at = $this->created_at->format('m.d.Y');
        $this->updated_at = $this->updated_at->format('m.d.Y');
        $this->active_class = $this->status ? "badge-success" : "badge-danger";
        $this->active_text = $this->status == Pos::POS_ACTIVE ? trans('content.active') : trans('content.disabled');
    }
}
