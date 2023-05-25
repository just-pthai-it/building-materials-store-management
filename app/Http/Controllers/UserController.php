<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserPostRequest;
use App\Http\Requests\User\UpdateProfilePatchRequest;
use App\Http\Requests\User\UpdateUserPatchRequest;
use App\Http\Requests\User\UploadAvatarPostRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct (UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index (Request $request) : JsonResponse
    {
        return $this->userService->list($request->all());
    }

//    public function search (Request $request) : JsonResponse
//    {
//        return $this->userService->search($request->all());
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserPostRequest $request
     * @return JsonResponse
     */
    public function store (StoreUserPostRequest $request) : JsonResponse
    {
        return $this->userService->store($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show (User $user) : JsonResponse
    {
        return $this->userService->get($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserPatchRequest $request
     * @param User                   $user
     * @return JsonResponse
     */
    public function update (UpdateUserPatchRequest $request, User $user) : JsonResponse
    {
        return $this->userService->update($user, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy (User $user) : JsonResponse
    {
        return $this->userService->delete($user);
    }

    public function myProfile () : JsonResponse
    {
        return $this->userService->myProfile();
    }

    public function updateMyProfile (UpdateProfilePatchRequest $request) : JsonResponse
    {
        return $this->userService->update(auth()->user(), $request->validated());
    }
}
