<?php

namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Poll\CreatePollActionData;
use App\DataObjects\Common\DataObjectCollectionMix;
use App\DataObjects\Poll\PollData;
use App\DataObjects\Poll\PollTranslationsData;
use App\DataObjects\TranslationData;
use App\Enums\PollStatusEnum;
use App\Models\Poll;
use App\Models\PollTranslation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;

/**
 * Author: Bekzod Raximov
 * Date: 12/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class PollService
{
    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 10, ?iterable $filters = null): DataObjectCollection
    {
        $model = Poll::applyEloquentFilters($filters)
            ->join('poll_translations', 'polls.id', '=', 'poll_translations.poll_id')
            ->where('poll_translations.locale', App::getLocale())
            ->select('polls.*', 'poll_translations.title as title', 'poll_translations.text as text')
            ->orderBy('polls.id', 'desc');
        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(fn($item) => PollData::fromModel($item));
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollectionMix
     */
    public function getAll(int $page = 1, int $limit = 10, ?iterable $filters = null): DataObjectCollectionMix
    {
        $model = Poll::applyEloquentFilters($filters)
            ->join('poll_translations', 'polls.id', '=', 'poll_translations.poll_id')
            ->where('polls.status', '=', PollStatusEnum::ACTIVE->value)
            ->where('poll_translations.locale', App::getLocale())
            ->select('polls.*', 'poll_translations.title as title', 'poll_translations.text as text')
            ->orderBy('polls.id', 'desc');
        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(fn($item) => PollData::fromModel($item));
        return new DataObjectCollectionMix($items, $totalCount, $limit, $page);
    }

    /**
     * @param int $id
     * @return PollData
     */
    public function getPollLocale(int $id): PollData
    {
        $poll = Poll::query()
            ->join('poll_translations', 'polls.id', '=', 'poll_translations.poll_id')
            ->where('polls.status', '=', PollStatusEnum::ACTIVE->value)
            ->where('poll_translations.locale', App::getLocale())
            ->select('polls.*', 'poll_translations.title as title', 'poll_translations.text as text')
            ->findOrFail($id);
        return PollData::fromModel($poll);
    }

    /**
     * @param int $id
     * @return PollTranslationsData
     */
    public function getPoll(int $id): PollTranslationsData
    {
        $poll = Poll::query()->with('translations')->findOrFail($id);
        $poll->translations->transform(fn(PollTranslation $locale) => TranslationData::fromModel($locale));
        return PollTranslationsData::fromModel($poll);
    }

    /**
     * @param CreatePollActionData $actionData
     * @param Collection $languages
     * @return int
     */
    public function store(CreatePollActionData $actionData, Collection $languages): int
    {
        $actionData->status = PollStatusEnum::ACTIVE->value;
        $poll = Poll::query()->create([
            'status' => PollStatusEnum::ACTIVE->value,
            'type' => $actionData->type,
        ]);
        $translations = [];
        foreach ($languages as $language) {
            $translations[] = [
                'poll_id' => $poll->id,
                'title' => $actionData->title[$language->code],
                'text' => $actionData->text[$language->code],
                'locale' => $language->code,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        PollTranslation::query()->insert($translations);
        return $poll->id;
    }

    /**
     * @param CreatePollActionData $actionData
     * @param int $id
     * @return void
     */
    public function update(CreatePollActionData $actionData, int $id): void
    {
        $poll = Poll::query()->with('translations')->findOrFail($id);
        foreach ($poll->translations as $translation) {
            $translation->update([
                'title' => $actionData->title[$translation->locale],
                'text' => $actionData->text[$translation->locale],
                'updated_at' => now()
            ]);
        }
        $poll->status = $actionData->status;
        if(!is_null($actionData->type)) {
            $poll->type = $actionData->type;
        }
        $poll->save();
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
       Poll::query()->findOrFail($id)->delete();
    }
}
