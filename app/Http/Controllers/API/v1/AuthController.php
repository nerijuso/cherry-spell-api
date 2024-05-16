<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\RegisterUserRequest;
use App\Http\Resources\API\DefaultResource;
use App\Http\Resources\API\v1\AuthResource;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Cashier;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request): \Illuminate\Http\JsonResponse|AuthResource
    {
        $sessionId = $request->get('checkout_session_id');
        $session = Cashier::stripe()->checkout->sessions->retrieve($sessionId);

        if ($session->payment_status !== 'paid') {
            return (new DefaultResource([
                'status' => 'failed',
                'message' => trans('kernel.messages.subscription_is_not_payed'),
            ]))->response()->setStatusCode(406);
        }

        $user = DB::transaction(function () use ($request) {
            $lead = Lead::where('session_id', $request->session_id)->firstOrFail();
            $user = User::lockForUpdate()->where('id', $lead->user_id)->firstOrFail();
            $user->email = $request->email;
            $user->password = $request->password;
            $user->save();

            $lead->setToRegistered();

            return $user;
        }, 5);

        return new AuthResource([
            'user' => $user,
            'token' => $user->createToken('auth')->plainTextToken,
        ]);
    }
}
