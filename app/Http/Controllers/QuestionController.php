<?php

namespace App\Http\Controllers;

use App\Filters\Question\QuestionSearchFilter;
use App\Services\PollService;
use App\Services\QuestionService;
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
        $poll = $this->pollService->getPoll($pollId);
        $questions = $this->service->getPollQuestions($pollId, $filters);

        return view('admin.polls.questions', compact('poll', 'questions'));
    }

    /**
     * @return View
     */
    public function constructor(): View
    {
        return view('admin.questions.constructor');
    }
}
