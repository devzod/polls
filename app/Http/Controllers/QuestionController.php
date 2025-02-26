<?php

namespace App\Http\Controllers;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Question\CreateQuestionActionData;
use App\Enums\QuestionTypeEnum;
use App\Filters\Question\QuestionSearchFilter;
use App\Models\Question;
use App\Services\LanguageService;
use App\Services\PollService;
use App\Services\QuestionService;
use App\ViewModels\Question\QuestionViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct(
        protected QuestionService $service,
        protected PollService $pollService,
        protected LanguageService $languageService,
    )
    {
    }

    public function index(Request $request): View
    {
        $filters[] = QuestionSearchFilter::getRequest($request);
        $questions = $this->service->index(page: (int)$request->get('page'), limit: (int)$request->get('limit', 10), filters: $filters);
        $types = QuestionTypeEnum::cases();

        return (new PaginationViewModel($questions, QuestionViewModel::class))->toView('admin.questions.index', compact('types'));
    }

    /**
     * @param int $pollId
     * @param Request $request
     * @return View
     */
    public function pollQuestions(int $pollId, Request $request): View
    {
        $filters[] = QuestionSearchFilter::getRequest($request);
        $poll = $this->pollService->getPollLocale($pollId);
        $questions = $this->service->getPollQuestions($pollId, page: (int)$request->get('page'), limit: (int)$request->get('limit', 10), filters: $filters);
        $types = QuestionTypeEnum::cases();
        return (new PaginationViewModel($questions, QuestionViewModel::class))->toView('admin.polls.questions', compact('poll', 'types'));
    }

    /**
     * @return View
     */
    public function constructor(): View
    {
        return view('admin.questions.constructor');
    }

    public function create(): View
    {
        $locales = $this->languageService->getAll();
        $types = QuestionTypeEnum::cases();
        return view('admin.questions.create', compact( 'locales', 'types'));
    }

    /**
     * @param CreateQuestionActionData $actionData
     * @return RedirectResponse
     * @throws \Exception
     */
    public function store(CreateQuestionActionData $actionData):RedirectResponse
    {
        $this->service->storeQuestion($actionData);
        return redirect()->route('questions.index')
            ->with('success', trans('form.success_create', ['attribute' => trans('content.question')]));
    }

    /**
     * @param int $questionId
     * @return RedirectResponse
     */
    public function delete(int $questionId): RedirectResponse
    {
        $this->service->delete($questionId);
        return redirect()->back()
            ->with('success', trans('form.success_delete', ['attribute' => trans('content.question')]));
    }
}
