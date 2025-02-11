<?php
declare(strict_types = 1);
namespace App\ActionData\Language;

use Akbarali\ActionData\ActionDataBase;
use Illuminate\Http\UploadedFile;

class CreateLanguageActionData extends ActionDataBase
{
    public ?int $id;
    public ?string $name;
    public ?string $code;
    public ?UploadedFile $icon;

    protected array $rules = [
        'name' => "required|string",
        'code' => "required|string",
        'icon' => "nullable|file|mimes:png,jpg,jpeg,webp|max:2048",
    ];
}
