<?php

namespace App\Http\Controllers\Api;

use Akbarali\ViewModel\Presenters\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\PollService;
use App\Services\QuestionService;

class QuestionController extends Controller
{
    public function __construct(protected QuestionService $service, protected PollService $pollService)
    {
    }

    /**
     * @param int $id
     * @return ApiResponse
     */
    public function get(int $id):ApiResponse
    {
       $question = $this->service->getQuestion($id);
       return ApiResponse::getSuccessResponse($question);
    }

}
