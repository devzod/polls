<?php

namespace App\ViewModels\Participant;

use Akbarali\ViewModel\BaseViewModel;
use App\Enums\ParticipantStatusEnum;
use Carbon\Carbon;

/**
 * Author: Bekzod Raximov
 * Date: 15/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class ParticipantViewModel extends BaseViewModel
{
    public int $id;
    public string $name;
    public string $phone;
    public Carbon|string|null $birthday = null;
    public string|null $gender = null;
    public int $status;
    public Carbon|string $created_at;
    public Carbon|string $updated_at;
    public string $active_class = "";
    public string $active_text = "";

    protected function populate()
    {
        $this->created_at = $this->created_at->format('d.m.Y');
        $this->active_class = $this->status == ParticipantStatusEnum::ACTIVE->value ? "badge-success" : "badge-danger";
        $this->active_text = $this->status == ParticipantStatusEnum::ACTIVE->value ? trans('content.active') : trans('content.disabled');
    }
}
