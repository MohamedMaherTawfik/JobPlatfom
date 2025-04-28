<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class followController extends Controller
{
    use apiResponse;

    public function follow(User $user)
    {
        Auth::user()->follow($user);

        return $this->apiResponse($user, 'Followed Successfully');
    }

    public function unfollow(User $user)
    {
        Auth::user()->unfollow($user);

        return $this->apiResponse($user, 'Unfollowed Successfully');
    }

}
