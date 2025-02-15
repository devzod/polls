<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Stuff\CreateAdminStuffActionData;
use App\ActionData\Stuff\UpdateAdminStuffActionData;
use App\Filters\Stuff\StuffSearchFilter;
use App\Services\StuffService;
use App\ViewModels\Stuff\StuffViewModel;
use Illuminate\Http\RedirectResponse;
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

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.stuffs.create');
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $stuff = $this->service->getStuff($id);
        return view('admin.stuffs.edit', compact('stuff'));

    }

    public function store(CreateAdminStuffActionData $actionData): RedirectResponse
    {
        $this->service->create($actionData);
        return redirect()->route('stuff.index')
        ->with('success', trans('form.success_create', ['attribute' => trans('content.stuff')]));

    }

    public function update(int $id, UpdateAdminStuffActionData $actionData): RedirectResponse
    {
//        dd($actionData);
        $this->service->updateAdmin($actionData, $id);
        return redirect()->route('stuff.index')
            ->with('success', trans('form.success_update', ['attribute' => trans('content.stuff')]));
    }
}
