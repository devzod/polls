<?php
declare(strict_types=1);

namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\POS\PosActionData;
use App\DataObjects\Common\DataObjectCollectionMix;
use App\DataObjects\POS\PosData;
use App\Enums\PosStatusEnum;
use App\Models\Pos;

/**
 * Author: Bekzod Raximov
 * Date: 11/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class PosService
{
    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 15, ?iterable $filters = null): DataObjectCollection
    {
        $query = Pos::applyEloquentFilters($filters)
            ->join('region_translations', 'region_translations.region_id', '=', 'pos.region_id')
            ->where('region_translations.locale', '=', app()->getLocale())
            ->select('pos.*', 'region_translations.name as region_name')
            ->orderBy('pos.id', 'desc');
        $total = $query->count();
        $skip = ($page - 1) * $limit;
        $items = $query->skip($skip)->take($limit)->get();
        $items->transform(fn(Pos $pos) => PosData::fromModel($pos));
        return new DataObjectCollection($items, $total, $limit, $page);
    }

    /**
     * @param PosActionData $actionData
     * @return void
     */
    public function create(PosActionData $actionData): void
    {
        $actionData->status = PosStatusEnum::ACTIVE->value;
        Pos::query()->create($actionData->toArray());
    }

    /**
     * @param int $id
     * @return PosData
     */
    public function getPosAdmin(int $id): PosData
    {
        $pos = Pos::query()
            ->join('region_translations', 'region_translations.region_id', '=', 'pos.region_id')
            ->where('pos.id', '=', $id)
            ->where('region_translations.locale', '=', app()->getLocale())
            ->select('pos.*', 'region_translations.name as region_name')
            ->firstOrFail();

        return PosData::fromModel($pos);
    }

    /**
     * @param int $id
     * @return PosData
     */
    public function getPos(int $id): PosData
    {
        $pos = Pos::query()
            ->join('region_translations', 'region_translations.region_id', '=', 'pos.region_id')
            ->where('pos.id', '=', $id)
            ->where('pos.status', '=', PosStatusEnum::ACTIVE->value)
            ->where('region_translations.locale', '=', app()->getLocale())
            ->select('pos.*', 'region_translations.name as region_name')
            ->firstOrFail();

        return PosData::fromModel($pos);
    }

    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollectionMix
     */
    public function getAll(int $page = 1, int $limit = 15, ?iterable $filters = null): DataObjectCollectionMix
    {
        $model = Pos::applyEloquentFilters($filters)
            ->join('region_translations', 'region_translations.region_id', '=', 'pos.region_id')
            ->where('pos.status', '=', PosStatusEnum::ACTIVE->value)
            ->where('region_translations.locale', '=', app()->getLocale())
            ->select('pos.*', 'region_translations.name as region_name')
            ->orderBy('pos.id', 'desc');;
        $total = $model->count();
        $skip = ($page - 1) * $limit;
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(fn(Pos $pos) => PosData::fromModel($pos));
        return new DataObjectCollectionMix($items, $total, $limit, $page);
    }

    /**
     * @param int $id
     * @param PosActionData $actionData
     * @return void
     */
    public function update(int $id, PosActionData $actionData): void
    {
        Pos::query()->findOrFail($id)->update($actionData->toArray());
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        Pos::query()->findOrFail($id)->delete();
    }
}
