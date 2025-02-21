<?php

namespace App\Services;

use App\DataObjects\Question\QuestionData;
use App\DataObjects\Question\QuestionLocaleData;
use App\Models\Question;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;

/**
 * Author: Bekzod Raximov
 * Date: 21/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class QuestionService
{
    /**
     * @param int $pollId
     * @param iterable|null $filters
     * @return Collection
     */
    public function getPollQuestions(int $pollId, iterable|null $filters = null): Collection
    {
        $questions = Question::applyEloquentFilters($filters)
            ->join('question_translations', 'questions.id', '=', 'question_translations.question_id')
            ->where('question_translations.locale', '=', App::getLocale())
            ->where('questions.poll_id', $pollId)
            ->select('questions.*', 'question_translations.title as title',
                'question_translations.text as text', 'question_translations.image_title as image_title')
            ->get();

        $questions->transform(fn ($question) => QuestionLocaleData::fromModel($question));

        return $questions;
    }
}
