<?php

namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\DataObjects\Poll\PollData;
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
}
