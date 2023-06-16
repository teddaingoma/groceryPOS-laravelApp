<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function login_account(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|email',
            'password' => 'required',
        ]);

        if (!auth()->attempt($request->only('username', 'password'), $request->remember))
        {
            $message = "Invalid Login Details";
            return back()->with('status', $message);
        }

        $message = "Welcome ".auth()->user()->name;

        return redirect()->route('home.index')->with('status', $message);
    }
}