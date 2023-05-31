<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{

    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function signup()
    {
        return view('auth.signup');
    }

    public function add_account(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $name = $request->name;
        $username = $request->username;
        $email = $request->email;
        $password = $request->password;

        User::create([
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        return redirect()->route('login');
    }
}
