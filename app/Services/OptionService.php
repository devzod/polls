<?php

namespace App\Services;

use App\ActionData\Option\StoreOptionActionData;
use App\Models\Option;
use App\Models\OptionTranslation;
use Illuminate\Support\Facades\Storage;

/**
 * Author: Bekzod Raximov
 * Date: 28/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class OptionService
{
    public function store(int $questionId, StoreOptionActionData $actionData): void
    {
        $image = $actionData->option_image?->storePubliclyAs('questions', $actionData->option_image->hashName(), 'public');
        $option = Option::query()->create([
            'question_id' => $questionId,
            'image' => $image ?? null,
            'next_question_id' => $actionData->next_question_id,
        ]);

        foreach ($actionData->option_title as $locale => $title) {
            OptionTranslation::query()->create([
                'option_id' => $option->id,
                'title' => $title,
                'image_title' => $actionData->option_title[$locale] ?? null,
                'locale' => $locale,
            ]);
        }
    }

    public function update(int $questionId, StoreOptionActionData $actionData): void
    {

    }
    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        Option::query()->findOrFail($id)->delete();
    }

    /**
     * @param int $id
     * @return void
     */
    public function removeNextQuestion(int $id): void
    {
        Option::query()->findOrFail($id)->update(['next_question_id' => null]);
    }
}
