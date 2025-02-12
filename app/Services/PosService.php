<?php
declare(strict_types=1);

namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\POS\PosActionData;
use App\DataObjects\POS\PosData;
use App\Models\Pos;
use Illuminate\Database\Eloquent\Collection;

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
        $actionData->status = Pos::POS_ACTIVE;
        Pos::query()->create($actionData->toArray());
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
            ->where('region_translations.locale', '=', app()->getLocale())
            ->select('pos.*', 'region_translations.name as region_name')
            ->firstOrFail();

        return PosData::fromModel($pos);
    }

    /**
     * @return Collection
     */
    public function getAllPos(): Collection
    {
        $pos = Pos::query()
            ->join('region_translations', 'region_translations.region_id', '=', 'pos.region_id')
            ->where('pos.status', '=', Pos::POS_ACTIVE)
            ->where('region_translations.locale', '=', app()->getLocale())
            ->select('pos.*', 'region_translations.name as region_name')
            ->get();
        $pos->transform(fn(Pos $pos) => PosData::fromModel($pos));
        return $pos;
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
