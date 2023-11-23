<?php

declare(strict_types=1);

namespace App\Services;


final readonly class AuthenticationService
{

    public function createAccessToken() : string 
    {
        // create api token
        $token = auth()->user()->createToken('auth_token')->plainTextToken;

        // return the token

        return $token;
    }
}
