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
class UpdateQuestionActionData extends ActionDataBase
{
    public array $title;
    public array|null $text;
    public UploadedFile|null $image;
    public UploadedFile|null $bg_image;
    public UploadedFile|null $video;
    public array|null $image_title;
    public string $type; //image, radio, multiple, text

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
    ];
}
