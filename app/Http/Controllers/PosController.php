<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\POS\PosActionData;
use App\Filters\POS\PosSearchFilter;
use App\Services\PosService;
use App\Services\RegionService;
use App\ViewModels\POS\PosViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PosController extends Controller
{
    public function __construct(protected PosService $service, protected RegionService $regionService)
    {
    }


    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $filters[] = PosSearchFilter::getRequest($request);
        $POS = $this->service->paginate(page: (int)$request->get('page'), limit: (int)$request->get('limit', 15), filters: $filters);
        $regions = $this->regionService->getRegions();

        return (new PaginationViewModel($POS, PosViewModel::class))->toView('admin.pos.index', compact('regions'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $regions = $this->regionService->getRegions();
        return view('admin.pos.create', compact('regions'));
    }

    /**
     * @param PosActionData $actionData
     * @return RedirectResponse
     */
    public function store(PosActionData $actionData): RedirectResponse
    {
        $this->service->create($actionData);
        return redirect()->route('pos.index')
            ->with('success', trans('form.success_create', ['attribute' => trans('content.pos')]));
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $pos = $this->service->getPos($id);
        $regions = $this->regionService->getRegions();

        return view('admin.pos.edit', compact('pos', 'regions'));
    }

    /**
     * @param int $id
     * @param PosActionData $actionData
     * @return RedirectResponse
     */
    public function update(int $id, PosActionData $actionData): RedirectResponse
    {
        $this->service->update($id, $actionData);
        return redirect()->route('pos.index')
            ->with('success', trans('form.success_update', ['attribute' => trans('content.pos')]));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->service->delete($id);
        return redirect()->route('pos.index')
            ->with('success', trans('form.success_delete', ['attribute' => trans('content.pos')]));
    }
}
