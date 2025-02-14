<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Akbarali\ViewModel\Presenters\ApiResponse;
use App\Filters\Pos\PosSearchFilter;
use App\Http\Controllers\Controller;
use App\Services\PosService;
use App\Services\RegionService;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function __construct(protected PosService $service, protected RegionService $regionService)
    {
    }

    public function getAll(Request $request): ApiResponse
    {
        $filters[] = PosSearchFilter::getRequest($request);
        $response = $this->service->getAll(page: (int)$request->get('page'), limit: (int)$request->get('limit', 15), filters: $filters);
        return ApiResponse::getSuccessResponse($response);
    }
}
