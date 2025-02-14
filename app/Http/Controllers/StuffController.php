<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Akbarali\ViewModel\PaginationViewModel;
use App\Filters\Stuff\StuffSearchFilter;
use App\Services\StuffService;
use App\ViewModels\Stuff\StuffViewModel;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StuffController extends Controller
{
    public function __construct(protected StuffService $service)
    {
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $filters[] = StuffSearchFilter::getRequest($request);
        $stuffs = $this->service->paginate(page: (int)$request->get('page'), limit: (int)$request->get('limit', 15), filters: $filters);

        return (new PaginationViewModel($stuffs, StuffViewModel::class))->toView('admin.stuffs.index');
    }
}
