<?php
declare(strict_types=1);

namespace App\ViewModels\Region;

use Akbarali\ViewModel\BaseViewModel;
use Carbon\Carbon;

/**
 * Author: Bekzod Raximov
 * Date: 11/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class RegionViewModel extends BaseViewModel
{

    public  int $id;
    public  string $name;
    public  string $locale;
    public Carbon|string  $created_at = "";
    public bool $status;
    public string $active_class = "";
    public string $active_text = "";

    protected  function  populate():void
    {
        $this->created_at = $this->created_at->format('m.d.Y H:i');
        $this->active_class = $this->status ? "badge-success" : "badge-danger";
        $this->active_text = $this->status ? trans('content.active') : trans('content.disabled');
    }
}
