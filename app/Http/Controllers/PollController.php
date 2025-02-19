<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Poll\CreatePollActionData;
use App\Enums\PollStatusEnum;
use App\Filters\Poll\PollSearchFilter;
use App\Services\LanguageService;
use App\Services\PollService;
use App\ViewModels\Poll\PollViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PollController extends Controller
{
    public function __construct(protected PollService $service, protected LanguageService $languageService)
    {
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $filters[] = PollSearchFilter::getRequest($request);
        $polls = $this->service->paginate(page: (int)$request->get('page'), limit: (int)$request->get('limit', 10), filters: $filters);

        return (new PaginationViewModel($polls, PollViewModel::class))->toView('admin.polls.index');
    }

    /**
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        return view('admin.polls.show');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $locales = $this->languageService->getAll();
        return view('admin.polls.create', compact('locales'));
    }

    /**
     * @param CreatePollActionData $actionData
     * @return RedirectResponse
     */
    public function store(CreatePollActionData $actionData): RedirectResponse
    {
        $languages = $this->languageService->getAll();
        $this->service->store($actionData, $languages);
        return redirect()->route('polls.index')
            ->with('success', trans('form.success_create', ['attribute' => trans('content.poll')]));
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $poll = $this->service->getPoll($id);
        $statuses = PollStatusEnum::cases();
        return view('admin.polls.edit', compact('poll', 'statuses'));
    }

    /**
     * @param CreatePollActionData $actionData
     * @param int $id
     * @return RedirectResponse
     */
    public function update(CreatePollActionData $actionData, int $id): RedirectResponse
    {
        $this->service->update($actionData, $id);
        return redirect()->route('polls.index')
            ->with('success', trans('form.success_update', ['attribute' => trans('content.poll')]));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->service->delete($id);
        return redirect()->route('polls.index')
            ->with('success', trans('form.success_delete', ['attribute' => trans('content.poll')]));

    }
}
