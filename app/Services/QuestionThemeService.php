<?php

namespace App\Services;

use App\DataObjects\QuestionTheme\QuestionThemeData;
use App\Models\QuestionTheme;
use Illuminate\Database\Eloquent\Collection;

/**
 * Author: Bekzod Raximov
 * Date: 20/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class QuestionThemeService
{
    /**
     * @return Collection
     */
    public function getThemes():Collection
    {
        $themes = QuestionTheme::all();

        $themes->transform(fn (QuestionTheme $theme) => QuestionThemeData::fromModel($theme));

        return $themes;
    }
}
