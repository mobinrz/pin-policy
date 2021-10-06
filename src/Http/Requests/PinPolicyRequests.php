<?php

namespace Mobin\PinPolicy\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Mobin\PinPolicy\Rules\IsPinConsecutive;
use Mobin\PinPolicy\Rules\IsPinHasPreviousHistory;

class PinPolicyRequests extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'pin' => ['digits:4', 'required', 'confirmed', 'different:old_pin',
                new IsPinHasPreviousHistory(),
                new IsPinConsecutive()
            ]
        ];
    }
}

