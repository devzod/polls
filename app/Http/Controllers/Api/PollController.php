<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Akbarali\ViewModel\Presenters\ApiResponse;
use App\Filters\Poll\PollSearchFilter;
use App\Http\Controllers\Controller;
use App\Services\LanguageService;
use App\Services\PollService;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function __construct(protected PollService $service, protected LanguageService $languageService)
    {
    }

    /**
     * @param Request $request
     * @return ApiResponse
     */
    public function getAll(Request $request): ApiResponse
    {
        $filters[] = PollSearchFilter::getRequest($request);
        $response = $this->service->getAll(page: (int)$request->get('page'), limit: (int)$request->get('limit', 15), filters: $filters);
        return ApiResponse::getSuccessResponse($response);
    }

    public function get(int $id): ApiResponse
    {
        $response = $this->service->getPoll($id);
        return ApiResponse::getSuccessResponse($response);
    }

}
