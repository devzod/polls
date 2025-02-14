<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Akbarali\ViewModel\Presenters\ApiResponse;
use App\ActionData\Stuff\LoginActionData;
use App\Exceptions\LoginFailedException;
use App\Http\Controllers\Controller;
use App\Services\StuffService;
use Illuminate\Http\Request;

class StuffAuthController extends Controller
{
    public function __construct(protected StuffService $service)
    {
    }

    /**
     * @param LoginActionData $actionData
     * @return ApiResponse
     * @throws LoginFailedException
     */
    public function login(LoginActionData $actionData): ApiResponse
    {
        $response = $this->service->login($actionData->login, $actionData->password);
        return ApiResponse::getSuccessResponse($response);
    }

    /**
     * @param Request $request
     * @return ApiResponse
     */
    public function logout(Request $request): ApiResponse
    {
        $response = $this->service->logout($request);
        return ApiResponse::getSuccessResponse($response);
    }
}
