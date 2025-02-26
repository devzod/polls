<?php

namespace App\ActionData\Question;

use Akbarali\ActionData\ActionDataBase;
use Illuminate\Http\UploadedFile;

/**
 * Author: Bekzod Raximov
 * Date: 25/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class CreateQuestionActionData extends ActionDataBase
{
    public array $title;
    public array|null $text;
    public UploadedFile|null $image;
    public UploadedFile|null $bg_image;
    public UploadedFile|null $video;
    public array|null $image_title;
    public string $type; //image, radio, multiple, text
    public array|null $option_title;
    public array|null $option_image;
    public array|null $option_image_title;

    protected array $rules = [
        "title" => "required|array",
        "title.*" => "required|string",
        "text" => "nullable|array",
        "text.*" => "nullable|string",
        "image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096",
        "bg_image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096",
        "image_title" => "nullable|array",
        "image_title.*" => "nullable|string",
        "video" => "nullable|file|mimetypes:video/mp4",
        'type' => 'required|string|in:text,image,radio,multiple',
        "option_title" => "nullable|array|required_if:type,radio,multiple",
        'option_title.*' => "nullable|array|required_if:type,radio,multiple",
        'option_title.*.*' => "nullable|string",
        'option_image' => 'nullable|array|required_if:type,image',
        'option_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        'option_image_title' => 'nullable|array',
        'option_image_title.*' => 'nullable|array',
        'option_image_title.*.*' => 'nullable|string',
    ];
}
