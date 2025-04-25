<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\addressRequest;
use App\Http\Requests\userRequest;
use App\Mail\RegisterMail;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    use apiResponse;

    public function register(userRequest $request)
    {
        $fields = $request->validated();
        $user = $fields;
        $user['password'] = bcrypt($user['password']);
        $user = User::create($user);
        if (!$user) {
            return $this->sendError('Register Failed');
        }
        return $this->apiResponse($user, 'Register Successfully');
    }

    public function login()
    {
        $token=Auth::attempt(request(['email', 'password']));
        if (!$token) {
            return $this->sendError('Login Failed');
        }
        $success = $this->respondWithToken($token);

        return $this->apiResponse($success->original, 'Login Successfully');
    }
    public function profile()
    {
        $user=User::with('addresses')->find(Auth::user()->id);
        if(!$user){
            return $this->sendError('User Not Found');
        }
        return $this->apiResponse($user, 'Profile');
    }

    public function logout()
    {
        Auth::logout();

        return $this->apiResponse([], 'Logout Successfully');
    }

    public function refresh()
    {
        $token = $this->respondWithToken(Auth::refresh());
        return $this->apiResponse($token->original, 'Refresh Successfully');
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}
