<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class AuthenticationService
{
    public function login (string $email, string $password, ?bool $isRememberMe) : JsonResponse
    {
        auth()->attempt(['email' => $email, 'password' => $password]);

        $responseData = [
            'access_token' => $this->__generateTokenForResponse([]),
        ];

        if ($isRememberMe === true)
        {
            $responseData['refresh_token'] = $this->__generateTokenForResponse([], true);
        }

        return response()->json(['data' => $responseData]);
    }

    public function refreshToken () : JsonResponse
    {
        return response()->json(['data' => [
            'access_token' => $this->__generateTokenForResponse([]),
        ]]);
    }

    private function __generateTokenForResponse (array $permissions, bool $isRefreshToken = false) : array
    {
        if ($isRefreshToken)
        {
            $token = auth()->user()->createToken('refresh_token', $permissions, now()->addMonth());
        }
        else
        {
            $token = auth()->user()->createToken('access_token', $permissions);
        }

        return [
            'token'      => $token->plainTextToken,
            'expires_at' => $token->accessToken->expires_at,
        ];
    }
}
