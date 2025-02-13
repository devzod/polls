<?php

namespace App\ViewModels\Poll;

use Akbarali\ViewModel\BaseViewModel;
use App\Models\Pos;
use Carbon\Carbon;

/**
 * Author: Bekzod Raximov
 * Date: 12/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class PollViewModel extends BaseViewModel
{
    public int $id;
    public int $type;
    public string $title;
    public string|null $text;
    public bool $status;
    public Carbon|string $created_at;
    public Carbon|string $updated_at;
    public string $active_class = "";
    public string $active_text = "";

    protected function populate()
    {
        $this->created_at = $this->created_at->format('d.m.Y H:i');
        $this->active_class = $this->status ? "badge-success" : "badge-danger";
        $this->active_text = $this->status ? trans('content.active') : trans('content.disabled');
    }
}
