<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Langsung tampilkan view-nya tanpa mengirim data apapun
        return view('admin.manage-user');
    }
}
