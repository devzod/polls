<?php
declare(strict_types=1);
namespace App\ViewModels\Language;

use Akbarali\ViewModel\BaseViewModel;
use Carbon\Carbon;

class LanguageViewModel extends BaseViewModel
{
    public int $id;
    public string $name;
    public Carbon|string $created_at = "";
    public string $code;
    public string $icon;

    protected function populate():void
    {
        $this->created_at = $this->created_at->format('d.m.Y H:i');
    }
}
