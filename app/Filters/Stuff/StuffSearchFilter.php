<?php

namespace App\Filters\Stuff;

use App\Filters\EloquentFilterContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Author: Bekzod Raximov
 * Date: 13/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class StuffSearchFilter implements EloquentFilterContract
{
    public function __construct(protected Request $request)
    {
    }

    public function applyEloquent(Builder $model): Builder
    {
        if ($this->request->has('search')) {
            $model->where('name', 'like', '%' . $this->request->get('search') . '%');
        }
        if ($this->request->has('phone')) {
            $model->where('phone', 'like', '%' . $this->request->get('phone') . '%');
        }
        if ($this->request->has('status')) {
            $model->where('status', '=', $this->request->get('status'));
        }
        return $model;
    }

    public static function getRequest(Request $request): static
    {
        return new static($request);
    }

}
