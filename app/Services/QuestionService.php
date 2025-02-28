<?php
declare (strict_types=1);

namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Question\CreateQuestionActionData;
use App\DataObjects\Option\OptionAdminData;
use App\DataObjects\Option\OptionData;
use App\DataObjects\Option\OptionTranslationData;
use App\DataObjects\Poll\PollTranslationsData;
use App\DataObjects\Question\QuestionAdminData;
use App\DataObjects\Question\QuestionData;
use App\DataObjects\Question\QuestionLocaleData;
use App\DataObjects\Question\QuestionTranslationData;
use App\DataObjects\TranslationData;
use App\Models\Option;
use App\Models\OptionTranslation;
use App\Models\PollQuestion;
use App\Models\Question;
use App\Models\QuestionTranslation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Author: Bekzod Raximov
 * Date: 21/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class QuestionService
{
    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function index(int $page = 1, int $limit = 15, ?iterable $filters = null): DataObjectCollection
    {
        $model = Question::applyEloquentFilters($filters)
            ->join('question_translations', 'questions.id', '=', 'question_translations.question_id')
            ->where('question_translations.locale', '=', App::getLocale())
            ->select('questions.*', 'question_translations.title as title',
                'question_translations.text as text', 'question_translations.image_title as image_title')
            ->orderByDesc('id');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(fn($question) => QuestionLocaleData::fromModel($question));

        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @return Collection
     */
    public function getAll():Collection
    {
        $model = Question::query()
            ->join('question_translations', 'questions.id', '=', 'question_translations.question_id')
            ->where('question_translations.locale', '=', App::getLocale())
            ->where('questions.status', '=', true);
            $model->select('questions.*', 'question_translations.title as title',
                'question_translations.text as text', 'question_translations.image_title as image_title')
            ->orderByDesc('questions.id');

        $items = $model->get();

        $items->transform(fn($question) => QuestionLocaleData::fromModel($question));
        return $items;
    }

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
            ->join('poll_questions', 'questions.id', '=', 'poll_questions.question_id')
            ->where('question_translations.locale', '=', App::getLocale())
            ->where('poll_questions.poll_id', $pollId)
            ->select('questions.*', 'question_translations.title as title',
                'question_translations.text as text', 'question_translations.image_title as image_title')
            ->orderByDesc('questions.id');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(fn($question) => QuestionLocaleData::fromModel($question));

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

    /**
     * @param int $questionId
     * @return QuestionAdminData
     */
    public function getQuestionAdmin(int $questionId):QuestionAdminData
    {
        $question = Question::query()
            ->with([
                'polls.translation',
                'translations',
                'options.translations',
                'options.nextQuestion.translation'
            ])->findOrFail($questionId);

        $question->options->transform(function ($questionOption) {
            $questionOption->translations->transform(fn($questionOptionTranslation) => OptionTranslationData::fromModel($questionOptionTranslation));
            $questionOption->nextQuestion = $questionOption->nextQuestion ? QuestionData::fromModel($questionOption->nextQuestion) : $questionOption->nextQuestion;
            return OptionAdminData::fromModel($questionOption);
        });

        $question->translations->transform(fn($questionTranslation) => QuestionTranslationData::fromModel($questionTranslation));

        $question->polls->transform(function ($poll) {
            $poll->translations->transform(fn($pollTranslation) => TranslationData::fromModel($pollTranslation));
            return PollTranslationsData::fromModel($poll);
        });

        return QuestionAdminData::fromModel($question);
    }

    /**
     * @param CreateQuestionActionData $actionData
     * @return bool
     * @throws \Exception
     */
    public function storeQuestion(CreateQuestionActionData $actionData): bool
    {
        try {
            DB::beginTransaction();

            $question = Question::query()->create([
                'type' => $actionData->type,
            ]);

            if ($actionData->poll_id) {
                PollQuestion::query()->create([
                    'poll_id' => $actionData->poll_id,
                    'question_id' => $question->id,
                ]);
            }
            if ($actionData->image) {
                $image = $actionData->image->storePubliclyAs('questions', $actionData->image->hashName(), 'public');
                $question->image = $image;
            }
            if ($actionData->bg_image) {
                $bg_image = $actionData->bg_image->storePubliclyAs('questions', $actionData->bg_image->hashName(), 'public');
                $question->bg_image = $bg_image;
            }
            if ($actionData->video) {
                $video = $actionData->video->storePubliclyAs('questions', $actionData->video->hashName(), 'public');
                $question->video = $video;
            }
            $question->save();
            foreach ($actionData->title as $locale => $title) {
                QuestionTranslation::query()->create([
                    'question_id' => $question->id,
                    'locale' => $locale,
                    'title' => $title,
                    'text' => $actionData->text[$locale] ?? null,
                    'image_title' => $actionData->image ? $actionData->image_title[$locale] ?? null : null,
                ]);
            }
            if ($actionData->type == 'image') {
                foreach ($actionData->option_image as $index => $image) {
                    $option = Option::query()->create([
                        'question_id' => $question->id,
                        'next_question_id' => $actionData->next_question_id[$index] ?? null,
                    ]);
                    $image = $image->storePubliclyAs('questions', $image->hashName(), 'public');
                    $option->image = $image;
                    if ($actionData->option_image_title && $actionData->option_image_title[$index + 1]) {
                        foreach ($actionData->option_image_title[$index + 1] as $locale => $title) {
                            OptionTranslation::query()->create([
                                'option_id' => $option->id,
                                'image_title' => $title,
                                'locale' => $locale,
                            ]);
                        }
                    }
                    $option->save();
                }
                DB::commit();
                return true;
            } else if ($actionData->type == 'radio' || $actionData->type == 'multiple') {
                foreach ($actionData->option_title as $index => $titles) {
                    $option = Option::query()->create([
                        'question_id' => $question->id,
                        'next_question_id' => $actionData->next_question_id[$index - 1] ?? null,
                    ]);
                    foreach ($titles as $locale => $title) {
                        OptionTranslation::query()->create([
                            'option_id' => $option->id,
                            'title' => $title,
                            'locale' => $locale,
                        ]);
                    }
                    $option->save();
                }
                DB::commit();
                return true;
            } else if ($actionData->type == 'text') {
                DB::commit();
                return true;
            } else {
                DB::rollBack();
                return false;
            }

        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * @param int $questionId
     * @return void
     */
    public function delete(int $questionId): void
    {
        $question = Question::query()->findOrFail($questionId);
        if ($question->image) {
            Storage::disk('public')->delete($question->image);
        }
        if ($question->bg_image) {
            Storage::disk('public')->delete($question->bg_image);
        }
        if ($question->video) {
            Storage::disk('public')->delete($question->video);
        }
        $question->delete();
    }
}
