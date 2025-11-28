<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\UserResource;

class UserApiController extends Controller
{
    public function index()
    {

        $users = User::latest()->paginate(10);


        return new UserResource(true, 'List Data Pengguna', $users);
    }
}
