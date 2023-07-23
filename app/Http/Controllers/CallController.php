<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCallRequest;
use App\Models\Call;
use App\Repository\CallRepository;
use App\Services\CallService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CallController extends Controller
{
    public function __construct(protected CallService $callService, protected CallRepository $repository) {}

    public function index(): View
    {
        $allCalls = $this->repository->getAll();

        return view('call.list', [
            'calls'         => $allCalls->filter(fn(Call $call) => $call->is_completed === false),
            'archivedCalls' => $allCalls->filter(fn(Call $call) => $call->is_completed === true),
        ]);
    }

    public function store(CreateCallRequest $request): RedirectResponse
    {
        $this->callService->saveCall($request->validated());

        return Redirect::route('call.create');
    }
}
