<?php

namespace App\Http\Controllers;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Participant\UpdateAdminParticipantActionData;
use App\ActionData\Stuff\UpdateAdminStuffActionData;
use App\Filters\Stuff\StuffSearchFilter;
use App\Services\ParticipantService;
use App\ViewModels\Participant\ParticipantViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ParticipantController extends Controller
{
    public function __construct(protected ParticipantService $service)
    {
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $filters[] = StuffSearchFilter::getRequest($request);
        $participants = $this->service->paginate(page: (int)$request->get('page'), limit: (int)$request->get('limit', 15), filters: $filters);

        return (new PaginationViewModel($participants, ParticipantViewModel::class))->toView('admin.participants.index');
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $participant = $this->service->getParticipant($id);
        return view('admin.participants.edit', compact('participant'));

    }

    /**
     * @param int $id
     * @param UpdateAdminParticipantActionData $actionData
     * @return RedirectResponse
     */
    public function update(int $id, UpdateAdminParticipantActionData $actionData): RedirectResponse
    {
        $this->service->updateAdmin($actionData, $id);
        return redirect()->route('participants.index')
            ->with('success', trans('form.success_update', ['attribute' => trans('content.participant')]));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->service->delete($id);
        return redirect()->route('participants.index')
            ->with('success', trans('form.success_delete', ['attribute' => trans('content.participant')]));
    }
}
