<?php

namespace App\ViewModels\Stuff;

use Akbarali\ViewModel\BaseViewModel;
use Carbon\Carbon;

/**
 * Author: Bekzod Raximov
 * Date: 13/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class StuffViewModel extends BaseViewModel
{
    public int $id;
    public string $name;
    public string $phone;
    public bool $status;
    public Carbon|string $created_at;
    public Carbon|string $updated_at;
    public string $active_class = "";
    public string $active_text = "";

    protected function populate()
    {
        $this->created_at = $this->created_at->format('d.m.Y');
        $this->active_class = $this->status ? "badge-success" : "badge-danger";
        $this->active_text = $this->status ? trans('content.active') : trans('content.disabled');
    }
}
