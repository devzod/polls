<?php
declare(strict_types=1);

namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Language\CreateLanguageActionData;
use App\DataObjects\Language\LanguageData;
use App\Models\Language;
use Illuminate\Validation\ValidationException;

/**
 * Author: Bekzod Raximov
 * Date: 10/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class LanguageService
{
    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 10, ?iterable $filters = null): DataObjectCollection
    {
        $model = Language::applyEloquentFilters($filters)
            ->orderBy('languages.id', 'desc');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (Language $language) {
            return LanguageData::createFromEloquentModel($language);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param CreateLanguageActionData $actionData
     * @return LanguageData
     * @throws ValidationException
     */
    public function create(CreateLanguageActionData $actionData): LanguageData
    {
        $actionData->validateException();
        $icon = $actionData->code . '.' . $actionData->icon->getClientOriginalExtension();
        $path = $actionData->icon->storeAs('public/flags', $icon);
        $data = $actionData->all();
        $data['icon'] = $path;
        $lang = Language::query()->create($data);
        return LanguageData::createFromEloquentModel($lang);
    }


    /**
     * @param CreateLanguageActionData $actionData
     * @param int $id
     * @return void
     * @throws ValidationException
     */
    public function update(CreateLanguageActionData $actionData, int $id): void
    {
        $actionData->validateException();
        $lang = $this->getOne($id);
        $lang->fill($actionData->all());
        $lang->save();
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $lang = $this->getOne($id);
        $lang->delete();
    }

    /**
     * @param int $id
     * @return Language
     */
    protected function getOne(int $id): Language
    {
        return Language::query()->findOrFail($id);
    }
}
