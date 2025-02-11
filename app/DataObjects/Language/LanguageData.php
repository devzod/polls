<?php
declare(strict_types=1);
namespace App\DataObjects\Language;

use Akbarali\DataObject\DataObjectBase;
use Carbon\Carbon;

class LanguageData extends  DataObjectBase
{
    public int $id;
    public string $name;
    public string $code;
    public string $icon;
    public Carbon $created_at;
}
