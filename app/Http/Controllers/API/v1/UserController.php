<?php

namespace App\Http\Controllers\API\v1;

use App\Actions\User\UploadPhoto;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\PasswordResetRequest;
use App\Http\Requests\API\v1\UploadPhotoRequest;
use App\Http\Requests\API\v1\UserLoginRequest;
use App\Http\Resources\API\DefaultResource;
use App\Http\Resources\API\v1\AuthResource;
use App\Http\Resources\API\v1\UpdateUserScreenNameRequest;
use App\Http\Resources\API\v1\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    public function index()
    {
        return new UserResource(auth_user());
    }

    public function login(UserLoginRequest $request): \Illuminate\Http\JsonResponse|AuthResource
    {
        if (Auth::guard('api')->attempt($request->only(['email', 'password']))) {
            $user = Auth::guard('api')->user();

            return new AuthResource([
                'user' => $user,
                'token' => $user->createToken('auth')->plainTextToken,
            ]);
        } else {
            return (new DefaultResource([
                'status' => 'failed',
                'message' => 'Bad username or password was provided',
            ]))->response()->setStatusCode(422);
        }
    }

    public function updateScreenName(UpdateUserScreenNameRequest $request): JsonResource
    {
        $user = DB::transaction(function () use ($request) {
            $user = User::lockForUpdate()->findOrFail(Auth::id());
            $user->name = $request->input('screen_name');
            $user->save();

            return $user;
        }, 5);

        return new UserResource($user);
    }

    public function passwordReset(PasswordResetRequest $request): JsonResource
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return new DefaultResource([
            'status' => $status === Password::RESET_LINK_SENT ? 'success' : 'failed',
            'message' => trans($status),
        ]);
    }

    public function uploadPhoto(UploadPhotoRequest $request)
    {

        $user = (new UploadPhoto)(auth_user(), $request);

        return new UserResource($user);
    }
}
