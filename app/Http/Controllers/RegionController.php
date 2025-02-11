<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Akbarali\ActionData\ActionDataException;
use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Region\CreateRegionActionData;
use App\ActionData\Role\CreateRoleActionData;
use App\Filters\Role\RolesFilter;
use App\Models\Region;
use App\Services\LanguageService;
use App\Services\RegionService;
use App\ViewModels\Region\RegionViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RegionController extends Controller
{

    public function __construct(protected RegionService $service, protected LanguageService $languageService)
    {
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $filters [] = RolesFilter::getRequest($request);
        $collection = $this->service->paginate(page: (int)$request->get('page'), limit: (int)$request->get('limit', 10), filters: $filters);

        return (new PaginationViewModel($collection, RegionViewModel::class))->toView('admin.regions.index');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $locales = $this->languageService->getAll();
        return view('admin.regions.create', compact('locales'));
    }

    /**
     * @param CreateRegionActionData $actionData
     * @return RedirectResponse
     */
    public function store(CreateRegionActionData $actionData): RedirectResponse
    {
        $languages = $this->languageService->getAll();
        $this->service->create($actionData, $languages);
        return redirect()->route('regions.index')
            ->with('success', trans('form.success_create', ['attribute' => trans('form.region.region')]));
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $region = $this->service->getRegion($id);
        return view('admin.regions.edit', compact('region'));
    }

    /**
     * @param int $id
     * @param CreateRegionActionData $actionData
     * @return RedirectResponse
     */
    public function update(int $id, CreateRegionActionData $actionData): RedirectResponse
    {
        $this->service->update($id, $actionData);

        return redirect()->route('regions.index')
            ->with('success', trans('form.success_update', ['attribute' => trans('form.region.region')]));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->service->delete($id);
        return redirect()->route('regions.index')
            ->with('success', trans('form.success_delete', ['attribute' => trans('form.region.region')]));
    }
}
