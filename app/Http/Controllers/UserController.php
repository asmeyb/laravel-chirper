<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        $chirps = $user->chirps()->latest()->paginate(10);
        return view('users.show', compact('user', 'chirps'));
    }
}
