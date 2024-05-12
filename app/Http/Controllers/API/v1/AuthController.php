<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\RegisterUserRequest;
use App\Http\Resources\API\v1\AuthResource;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request): JsonResource
    {
        $lead = Lead::where('session_id', $request->session_id)->firstOrFail();

        $user = DB::transaction(function () use ($request, $lead) {
            $user = User::lockForUpdate()->where('id', $lead->user_id)->firstOrFail();

            $user->email = $request->email;
            $user->password = $request->password;
            $user->save();

            return $user;
        }, 5);

        return new AuthResource([
            'user' => $user,
            'token' => $user->createToken('auth')->plainTextToken,
        ]);
    }
}
