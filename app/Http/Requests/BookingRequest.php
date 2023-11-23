<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Treblle\Tools\Http\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

final class BookingRequest extends FormRequest
{
    
    public function rules(): array
    {
        $today = now()->toDateString();

        return [
            'start_location' => "required|string",
            'end_location' => "required|string",
            'date' => "required|date|date_format:Y-m-d|after_or_equal:$today"
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], Status::UNPROCESSABLE_CONTENT->value));
    }
}
