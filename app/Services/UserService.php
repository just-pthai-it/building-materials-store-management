<?php

namespace App\Services;

use App\Helpers\Constants;
use App\Helpers\CusResponse;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

class UserService
{
    private FileService $fileService;

    /**
     * @param FileService $fileService
     */
    public function __construct (FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function list (array $inputs = []) : JsonResponse
    {
        $users = User::query()->with(['roles'])->filter($inputs)->paginate($inputs['per_page'] ?? Constants::DEFAULT_PER_PAGE);
        return (new UserCollection($users))->response();
    }

//    public function search (array $inputs = []) : JsonResponse
//    {
//        $users = User::query()->get(['id', 'name', 'email']);
//        return (new UserCollection($users))->response();
//    }

    public function get (User $user) : JsonResponse
    {
        return (new UserResource($user))->response();
    }

    public function store (array $inputs) : JsonResponse
    {
        $user = User::query()->create(Arr::except($inputs, ['avatar']));
        if (isset($inputs['avatar']))
        {
            $fileInfo = $this->fileService->putUploadedFileAs($inputs['avatar'], (string)$user->id, '/avatars');;
            $user->update(['avatar' => $fileInfo['url']]);
        }

        return (new UserResource($user))->response();
    }

    public function update (User $user, array $inputs) : JsonResponse
    {
        if (isset($inputs['avatar']))
        {
            $fileInfo = $this->fileService->putUploadedFileAs($inputs['avatar'], (string)$user->id, '/avatars');;
            $inputs['avatar'] = $fileInfo['url'];
        }
        $user->update($inputs);

        return CusResponse::successful();
    }


    public function delete (User $user) : JsonResponse
    {
        $user->delete();
        return CusResponse::successfulWithNoData();
    }

    public function myProfile () : JsonResponse
    {
        $userResource = new UserResource(auth()->user());
        return $userResource->response();
    }
}
