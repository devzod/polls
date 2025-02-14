<?php

namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use Akbarali\ViewModel\Presenters\ApiResponse;
use App\DataObjects\Common\DataObjectCollectionMix;
use App\DataObjects\Poll\PollData;
use App\Enums\PollStatusEnum;
use App\Models\Poll;
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
    public function getPoll(int $id):PollData
    {
        $poll = Poll::query()
            ->join('poll_translations', 'polls.id', '=', 'poll_translations.poll_id')
            ->where('polls.status', '=', PollStatusEnum::ACTIVE->value)
            ->where('poll_translations.locale', App::getLocale())
            ->select('polls.*', 'poll_translations.title as title', 'poll_translations.text as text')
            ->findOrFail($id);
        return PollData::fromModel($poll);
    }
}
