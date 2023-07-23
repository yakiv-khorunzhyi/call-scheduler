<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class CreateCallRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'time' => Carbon::createFromFormat('H:i', $this->input('time'), env('TIMEZONE'))->timestamp,
        ]);
    }

    public function rules(): array
    {
        return [
            'phone' => [
                'required',
                'string',
                'regex:/^380\d{9}$/i',
            ],
            'time'  => [
                'integer',
                'required',
            ],
            'text'  => [
                'required',
                'string',
                'min:3',
            ],
        ];
    }
}
