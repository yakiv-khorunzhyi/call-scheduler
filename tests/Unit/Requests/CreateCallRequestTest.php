<?php

namespace Requests;

use App\Http\Requests\CreateCallRequest;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;

class CreateCallRequestTest extends TestCase
{
    public function validationDataProvider(): array
    {
        return [
            'Correct case #1'   => [
                [
                    'phone' => '380990776411',
                    'time'  => time(),
                    'text'  => 'Hello, today we gonna talk about unit tests and we wrote something for you',
                ],
                true,
            ],
            'Incorrect case #1' => [
                [
                    'phone' => '3809907764111',    // more than 12 digits
                    'time'  => time(),
                    'text'  => 'Hello, today we gonna talk about unit tests and we wrote something for you',
                ],
                false,
            ],
            'Incorrect case #2' => [
                [
                    'phone' => '380990776411',
                    'time'  => '',    // empty string
                    'text'  => 'Hello, today we gonna talk about unit tests and we wrote something for you',
                ],
                false,
            ],
            'Incorrect case #3' => [
                [
                    'phone' => '380990776411',
                    'time'  => time(),
                    'text'  => '',    // empty string
                ],
                false,
            ],
        ];
    }

    /**
     * @dataProvider validationDataProvider
     *
     * @param array $call
     * @param bool  $expectedValidationResult
     *
     * @return void
     */
    public function testValidationRules(array $call, bool $expectedValidationResult)
    {
        $validator = Validator::make($call, (new CreateCallRequest())->rules());

        $this->assertSame($expectedValidationResult, $validator->passes());
    }
}
