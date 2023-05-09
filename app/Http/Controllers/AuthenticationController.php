<?php

namespace App\Http\Controllers;

use App\Http\Requests\Authentication\LoginPostRequest;
use App\Services\AuthenticationService;
use Illuminate\Http\JsonResponse;

class AuthenticationController extends Controller
{
    private AuthenticationService $authenticationService;

    /**
     * @param AuthenticationService $authenticationService
     */
    public function __construct (AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    public function login (LoginPostRequest $request) : JsonResponse
    {
        return $this->authenticationService->login($request->email, $request->password, $request->remember_me);
    }

    public function refreshToken () : JsonResponse
    {
        return $this->authenticationService->refreshToken();
    }
}
