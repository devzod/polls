<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Akbarali\ViewModel\PaginationViewModel;
use App\Filters\Poll\PollSearchFilter;
use App\Services\LanguageService;
use App\Services\PollService;
use App\ViewModels\Poll\PollViewModel;
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
     * @return View
     */
    public function create(): View
    {
        $locales = $this->languageService->getAll();
        return view('admin.polls.create', compact('locales'));
    }
}
