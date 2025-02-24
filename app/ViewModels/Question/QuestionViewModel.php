<?php

namespace App\ViewModels\Question;

use Akbarali\ViewModel\BaseViewModel;

/**
 * Author: Bekzod Raximov
 * Date: 22/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class QuestionViewModel extends BaseViewModel
{
    public int $id;
    public int $pollId;
    public int $questionThemeId;
    public string $type;
    public string|null $image;
    public string|null $bgImage;
    public bool $status;
    public string $title;
    public string|null $text;
    public string|null $imageTitle;
    public string $active_class = "";
    public string $active_text = "";

    protected function populate(): void
    {
        $this->active_class = $this->status ? "badge-success" : "badge-danger";
        $this->active_text = $this->status ? trans('content.active') : trans('content.disabled');
    }
}
