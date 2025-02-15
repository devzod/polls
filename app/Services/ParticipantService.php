<?php

namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Participant\UpdateAdminParticipantActionData;
use App\DataObjects\Participant\ParticipantData;
use App\Models\Participant;

/**
 * Author: Bekzod Raximov
 * Date: 15/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class ParticipantService
{
    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 10, ?iterable $filters = null): DataObjectCollection
    {
        $model = Participant::applyEloquentFilters($filters)->orderBy('id', 'desc');
        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(fn($item) => ParticipantData::fromModel($item));
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param UpdateAdminParticipantActionData $actionData
     * @param int $id
     * @return void
     */
    public function updateAdmin(UpdateAdminParticipantActionData $actionData, int $id): void
    {
        $stuff = Participant::query()->where('id', '=', $id)->firstOrFail();
        $stuff->update($actionData->toArray());
    }

    /**
     * @param int $id
     * @return ParticipantData
     */
    public function getParticipant(int $id): ParticipantData
    {
        $participant = Participant::query()->findOrFail($id);

        return ParticipantData::fromModel($participant);
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        Participant::query()->findOrFail($id)->delete();
    }
}
