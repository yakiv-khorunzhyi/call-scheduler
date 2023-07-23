<?php

namespace App\Observers;

use App\Models\Call;
use App\Services\ScheduleService;

class CallObserver
{
    public function __construct(protected ScheduleService $scheduleService) {}

    public function created(Call $call): void
    {
        $this->scheduleService->scheduleCall($call);
    }
}
