<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Treblle\Tools\Http\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

final class LoginRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'email'     =>  ['required','email','max:255'],
            'password'  =>  ['required','string']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], Status::UNPROCESSABLE_CONTENT->value));
    }

}
