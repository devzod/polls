<?php

namespace App\Filters\Pos;

use App\Filters\EloquentFilterContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Author: Bekzod Raximov
 * Date: 11/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class PosSearchFilter implements EloquentFilterContract
{
    public function __construct(protected Request $request)
    {
    }

    public function applyEloquent(Builder $model): Builder
    {
        if ($this->request->has('search')) {
            $model->where('pos.name', 'like', '%' . $this->request->get('search') . '%');
        }
        if ($this->request->has('phone')) {
            $model->where('pos.phone', 'like', '%' . $this->request->get('phone') . '%');
        }
        if ($this->request->has('status')) {
            $model->where('pos.status', '=', $this->request->get('status'));
        }
        if ($this->request->has('region_id')) {
            $model->where('region_translations.region_id', '=', $this->request->get('region_id'));
        }
        return $model;
    }

    public static function getRequest(Request $request): static
    {
        return new static($request);
    }

}
