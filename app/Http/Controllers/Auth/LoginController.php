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

        // a grocery owner should select their registered business
        if (auth()->user()->businesses()->count())
        {
            if (auth()->user()->businesses()->count() == 1)
            {
                foreach (auth()->user()->businesses as $business)
                {
                    return redirect()->route('home.index')->with('status', $message, 'business', $business);
                }
            }
            dd(auth()->user()->businesses()->count());
            return redirect()->route('select_registered_business')->with('status', $message);
        }

        // if not registered a business, prompt for options
        return redirect()->route('select_business')->with('status', $message);

        // return redirect()->route('home.index')->with('status', $message);
    }
}
