<?php

namespace App\Services;

use App\Models\Call;
use Illuminate\Support\Facades\Log;

class CallService
{
    public function saveCall(array $callData): Call
    {
        $callData['is_completed'] = false;

        return Call::create($callData);
    }

    public function makeCall(Call $call): void
    {
        Log::info('Call', [
            'phone'     => $call->phone,
            'text'      => $call->text,
            'date_time' => $call->getDateTimeString(),
        ]);

        $call->complete()
             ->save();
    }
}
