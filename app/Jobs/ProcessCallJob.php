<?php

namespace App\Jobs;

use App\Repository\CallRepository;
use App\Services\CallService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCallJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(protected string $id) {}

    public function handle(CallRepository $repository, CallService $callService): void
    {
        $callService->makeCall($repository->findOrFail($this->id));
        $this->delete();
    }
}
