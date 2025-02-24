<?php

namespace App\Http\Controllers;

use Akbarali\ViewModel\PaginationViewModel;
use App\Enums\QuestionTypeEnum;
use App\Filters\Question\QuestionSearchFilter;
use App\Services\PollService;
use App\Services\QuestionService;
use App\ViewModels\Question\QuestionViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct(protected QuestionService $service, protected PollService $pollService)
    {
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
}
