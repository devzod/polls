<?php
declare(strict_types=1);

namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Stuff\UpdateActionData;
use App\DataObjects\Common\TokenData;
use App\DataObjects\Stuff\StuffApiData;
use App\DataObjects\Stuff\StuffData;
use App\Exceptions\LoginFailedException;
use App\Models\Stuff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Author: Bekzod Raximov
 * Date: 13/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class StuffService
{
    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 10, ?iterable $filters = null): DataObjectCollection
    {
        $model = Stuff::applyEloquentFilters($filters)->orderBy('id', 'desc');
        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(fn($item) => StuffData::fromModel($item));
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param string $login
     * @param string $password
     * @return TokenData
     * @throws LoginFailedException
     */
    public function login(string $login, string $password): TokenData
    {
        $stuff = Stuff::query()->where('login', $login)->where('status', '=', 1)->first();

        if (!$stuff || !Hash::check($password, $stuff->password)) {
            throw new LoginFailedException();
        }
        $response['token'] = $stuff->createToken('auth_token')->plainTextToken;
        return TokenData::createFromArray($response);
    }

    /**
     * @param Request $request
     * @return StuffApiData
     */
    public function profile(Request $request): StuffApiData
    {
        $stuff = Stuff::query()->where('id', '=', $request->user()->id)->firstOrFail();
        return StuffApiData::fromModel($stuff);
    }

    /**
     * @param UpdateActionData $actionData
     * @return StuffApiData
     */
    public function update(UpdateActionData $actionData): StuffApiData
    {
        $stuff = Stuff::query()->where('id', '=', request()->user()->id)->firstOrFail();
        $stuff->name = $actionData->name;
        if ($actionData->phone !== null) {
            $stuff->phone = $actionData->phone;
        }
        $stuff->save();
        return StuffApiData::fromModel($stuff);
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function logout(Request $request): bool
    {
        return $request->user()->currentAccessToken()->delete();
    }
}
