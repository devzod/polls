<?php

namespace App\ActionData\Option;

use Akbarali\ActionData\ActionDataBase;
use Illuminate\Http\UploadedFile;

/**
 * Author: Bekzod Raximov
 * Date: 28/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class StoreOptionActionData extends ActionDataBase
{
    public string $type; //image, radio, multiple, text
    public array|null $option_title;
    public UploadedFile|null $option_image;
    public array|null $option_image_title;
    public array|null $next_question_id;

    protected array $rules = [
        'type' => 'required|string|in:text,image,radio,multiple',
        "option_title" => "nullable|array|required_if:type,radio,multiple",
        'option_title.*' => "nullable|string|required_if:type,radio,multiple",
        'option_image' => 'nullable|image|required_if:type,image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        'option_image_title' => 'nullable|array',
        'option_image_title.*' => 'nullable|string',
        "next_question_id" => "nullable|integer|exists:questions,id",
    ];
}
