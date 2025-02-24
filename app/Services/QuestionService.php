<?php

namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\DataObjects\Option\OptionData;
use App\DataObjects\Option\OptionTranslationData;
use App\DataObjects\Question\QuestionLocaleData;
use App\Models\Question;
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
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function getPollQuestions(int $pollId, int $page = 1, int $limit = 15, iterable|null $filters = null): DataObjectCollection
    {
        $model = Question::applyEloquentFilters($filters)
            ->join('question_translations', 'questions.id', '=', 'question_translations.question_id')
            ->where('question_translations.locale', '=', App::getLocale())
            ->where('questions.poll_id', $pollId)
            ->select('questions.*', 'question_translations.title as title',
                'question_translations.text as text', 'question_translations.image_title as image_title');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(fn ($question) => QuestionLocaleData::fromModel($question));

        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param int $questionId
     * @return QuestionLocaleData
     */
    public function getQuestion(int $questionId): QuestionLocaleData
    {
        $question = Question::query()
            ->with('options.translation')
            ->join('question_translations', 'questions.id', '=', 'question_translations.question_id')
            ->where('question_translations.locale', '=', App::getLocale())
            ->select('questions.*', 'question_translations.title as title',
                'question_translations.text as text', 'question_translations.image_title as image_title')
        ->firstOrFail($questionId);
        $question->options->transform(function ($questionOption) {
            $questionOption->translation = OptionTranslationData::fromModel($questionOption->translation);
            return OptionData::fromModel($questionOption);
        });
        return QuestionLocaleData::fromModel($question);
    }
}
