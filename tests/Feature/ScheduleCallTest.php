<?php

namespace Tests\Feature;

use App\Repository\CallRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ScheduleCallTest extends TestCase
{
    use DatabaseMigrations;
    use WithFaker;

    public function testScheduleCall(): void
    {
        $callData = [
            'phone' => $this->faker->regexify('^380\d{9}$'),
            'text'  => $this->faker->text,
            'time'  => $this->faker->regexify('^([01][0-9]|2[0-3]):[0-5][0-9]$'),
        ];

        $response = $this->post(route('call.store'), $callData);
        $call     = (new CallRepository())->first();

        $this->assertSame($callData['phone'], $call->phone);
        $this->assertSame($callData['text'], $call->text);
        $this->assertSame(
            Carbon::createFromFormat('H:i', $callData['time'], env('TIMEZONE'))->timestamp,
            $call->time
        );

        $response->assertRedirect('/');
    }
}
