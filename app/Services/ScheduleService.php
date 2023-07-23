<?php

namespace App\Services;

use App\Jobs\ProcessCallJob;
use App\Models\Call;
use Carbon\Carbon;

class ScheduleService
{
    public function scheduleCall(Call $call): void
    {
        $delayInSeconds = $call->time - Carbon::now(env('TIMEZONE'))->timestamp;

        ProcessCallJob::dispatch($call->_id)->delay($delayInSeconds > 0 ? $delayInSeconds : 0);
    }
}
