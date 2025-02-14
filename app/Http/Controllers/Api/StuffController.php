<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Akbarali\ViewModel\Presenters\ApiResponse;
use App\ActionData\Stuff\UpdateActionData;
use App\Http\Controllers\Controller;
use App\Services\StuffService;
use Illuminate\Http\Request;

class StuffController extends Controller
{
    public function __construct(protected StuffService $service)
    {
    }

    /**
     * @param Request $request
     * @return ApiResponse
     */
    public function profile(Request $request): ApiResponse
    {
        $response = $this->service->profile($request);

        return  ApiResponse::getSuccessResponse($response);
    }

    /**
     * @param UpdateActionData $actionData
     * @return ApiResponse
     */
    public function update(UpdateActionData $actionData): ApiResponse
    {
        $response = $this->service->update($actionData);

        return ApiResponse::getSuccessResponse($response);
    }
}
