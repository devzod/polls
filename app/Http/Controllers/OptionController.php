<?php

namespace App\Http\Controllers;

use App\ActionData\Option\StoreOptionActionData;
use App\Services\OptionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function __construct(protected OptionService $service)
    {
    }

    /**
     * @param int $questionId
     * @param StoreOptionActionData $actionData
     * @return RedirectResponse
     */
    public function store(int $questionId, StoreOptionActionData $actionData): RedirectResponse
    {
        $this->service->store($questionId, $actionData);
        return redirect()->back()
            ->with('success', trans('form.success_create', ['attribute' => trans('content.option')]));
    }

    /**
     * @param int $optionId
     * @return RedirectResponse
     */
    public function delete(int $optionId): RedirectResponse
    {
        $this->service->delete($optionId);
        return redirect()->back()
            ->with('success', trans('form.success_delete', ['attribute' => trans('content.option')]));
    }

    public function removeNext(int $optionId): RedirectResponse
    {
        $this->service->removeNextQuestion($optionId);
        return redirect()->back()
            ->with('success', trans('form.success_delete', ['attribute' => trans('content.in_question')]));
    }
}
