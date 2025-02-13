<?php
namespace App\Filters\Poll;

use App\Filters\EloquentFilterContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Author: Bekzod Raximov
 * Date: 12/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
class PollSearchFilter implements EloquentFilterContract
{
    public function __construct(protected Request $request)
    {
    }

    public function applyEloquent(Builder $model): Builder
    {
        if ($this->request->has('search')) {
            $model->where('poll_translations.title', 'like', '%' . $this->request->get('search') . '%');
        }
        if ($this->request->has('text')) {
            $model->where('poll_translations.text', 'like', '%' . $this->request->get('text') . '%');
        }
        if ($this->request->has('status')) {
            $model->where('polls.status', '=', $this->request->get('status'));
        }
        if ($this->request->has('type')) {
            $model->where('polls.type', '=', $this->request->get('type'));
        }
        return $model;
    }

    public static function getRequest(Request $request): static
    {
        return new static($request);
    }
}
