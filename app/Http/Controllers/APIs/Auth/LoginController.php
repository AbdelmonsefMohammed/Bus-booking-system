<?php

declare(strict_types=1);

namespace App\Http\Controllers\APIs\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Treblle\Tools\Http\Enums\Status;
use Illuminate\Contracts\Auth\Factory;
use App\Services\AuthenticationService;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Contracts\Support\Responsable;
use Treblle\Tools\Http\Responses\MessageResponse;

final class LoginController extends Controller
{
    public function __construct(
        private Factory $auth,
        private AuthenticationService $service, 
    ) {}
    
    public function __invoke(LoginRequest $request) : Responsable
    {

        if (! $this->auth->guard()->attempt($request->only(['email','password']))) {
            return new MessageResponse(
                data: [
                    'message' => 'Invalid credentials',
                ],
                status: Status::UNPROCESSABLE_CONTENT
            );
        }

        $token = $this->service->createAccessToken();

        return new MessageResponse(
            data: [
                'message' => 'User logged in successfully.',
                'token' => $token,
            ],
        );  
    }
}
