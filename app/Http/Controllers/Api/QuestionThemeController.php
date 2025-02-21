<?php

namespace App\Http\Controllers\Api;

use Akbarali\ViewModel\Presenters\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\QuestionThemeService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class QuestionThemeController extends Controller
{
    public function __construct(protected QuestionThemeService $service)
    {
    }

    /**
     * @return ApiResponse
     */
    public function getThemes():ApiResponse
    {
        $themes = $this->service->getThemes();
        return ApiResponse::getSuccessResponse($themes);
    }
}
