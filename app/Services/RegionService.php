<?php
declare(strict_types=1);

namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Region\CreateRegionActionData;
use App\DataObjects\Regions\RegionData;
use App\DataObjects\Regions\RegionLocaleData;
use App\DataObjects\Regions\RegionTranslationData;
use App\Models\Region;
use App\Models\RegionTranslation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

/**
 * Author: Bekzod Raximov
 * Date: 11/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class RegionService
{
    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 20, ?iterable $filters = null): DataObjectCollection
    {
        $model = Region::applyEloquentFilters($filters)
            ->join('region_translations', 'regions.id', '=', 'region_translations.region_id')
            ->where('region_translations.locale', App::getLocale())
            ->select('regions.*', 'region_translations.name as name', 'region_translations.locale as locale')
            ->orderBy('regions.id', 'desc');

        $total = $model->count();
        $skip = ($page - 1) * $limit;

        $items = $model->skip($skip)->take($limit)->get();

        $items->transform(fn(Region $region) => RegionLocaleData::fromModel($region));

        return new DataObjectCollection($items, $total, $limit, $page);
    }

    /**
     * @param CreateRegionActionData $actionData
     * @param Collection $languages
     * @return void
     */
    public function create(CreateRegionActionData $actionData, Collection $languages): void
    {
        $newRegion = Region::query()->create(['active' => true]);
        $translations = [];
        foreach ($languages as $language) {
            $translations[] = [
                'region_id' => $newRegion->id,
                'locale' => $language->code,
                'name' => $actionData->name[$language->code],
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        RegionTranslation::query()->insert($translations);
    }

    /**
     * @param int $id
     * @return RegionData
     */
    public function getRegion(int $id): RegionData
    {
        $region = Region::query()->with('translations')->findOrFail($id);
        $region->translations->transform(fn(RegionTranslation $locale) => RegionTranslationData::fromModel($locale));
        return RegionData::fromModel($region);
    }

    /**
     * @param int $id
     * @param CreateRegionActionData $actionData
     * @return void
     */
    public function update(int $id, CreateRegionActionData $actionData): void
    {
        $region = Region::query()->with('translations')->findOrFail($id);
        $region->active = $actionData->active;
        foreach ($region->translations as $translation) {
            $translation->name = $actionData->name[$translation->locale];
            $translation->save();
        }
        $region->save();
    }

    public function delete(int $id): void
    {
        Region::query()->findOrFail($id)->delete();
    }
}
