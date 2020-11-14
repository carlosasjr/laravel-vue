<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Auth\Traits\AuthTrait;
use App\Http\Controllers\Controller;


class AuthController extends Controller
{
    use AuthTrait;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }


    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function me()
    {
        $response = $this->getUser();

        if (!$this->isAuthenticated($response))
             return response()->json([$response['response'], $response['status']]);

        $user = $response['response'];

        return response()->json(compact('user'));
    }

}
