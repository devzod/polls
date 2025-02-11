<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Akbarali\ActionData\ActionDataException;
use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Language\CreateLanguageActionData;
use App\DataObjects\Language\LanguageData;
use App\Filters\Permissions\PermissionsFilter;
use App\Models\Language;
use App\Services\LanguageService;
use App\ViewModels\Language\LanguageViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LanguageController extends Controller
{
    public function __construct(protected LanguageService $service)
    {
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $filters[] = PermissionsFilter::getRequest($request);
        $collection = $this->service->paginate(page: (int)$request->get('page'), limit: (int)$request->get('limit', 10), filters: $filters);
        return (new PaginationViewModel($collection, LanguageViewModel::class))->toView('admin.languages.index');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $viewModel = LanguageViewModel::createEmpty();
        return $viewModel->toView('admin.languages.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     * @throws ActionDataException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->service->create(CreateLanguageActionData::createFromRequest($request));
        return redirect()->route('languages.index')
            ->with('success', trans('form.success_create', ['attribute' => trans('content.languages')]));
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $languages = Language::query()->findOrFail($id);
        $viewModel = new LanguageViewModel(LanguageData::fromModel($languages));

        return $viewModel->toView('admin.languages.edit');
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws ValidationException
     * @throws ActionDataException
     */
    public function update(Request $request, int $id): RedirectResponse
    {

        $actionDAta = CreateLanguageActionData::fromRequest($request);
        $this->service->update($actionDAta, $id);
        return redirect()->route('languages.index')
            ->with('success', trans('form.success_update', ['attribute' => trans('content.languages')]));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->service->delete($id);
        return redirect()->route('languages.index')
            ->with('success', trans('form.success_delete', ['attribute' => trans('content.languages')]));
    }
}
