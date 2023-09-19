<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    /**
     * view user profile
     */
    public function view_user_profile()
    {
        return view('users.view_user_profile');
    }

    /**
     * display form for editing a user profile
     */
    public function edit_user()
    {
        return view('users.edit_user');
    }

    /**
     * update a user in database
     */
    public function update_user(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
        ]);

        $users = User::all();

        // if user has has changed username, check if the updated username already exixsts
        if ( strtolower(auth()->user()->username) !== strtolower($request->username) )
        {
            foreach($users as $user)
            {

                if(strtolower($user->username) === strtolower($request->username))
                {
                    $message = "the username $request->username already exists, choose another one";
                    return redirect()->back()->with('status', $message);
                }
            }
        }

        $name = $request->name;
        $username = $request->username;
        $email = $request->email;

        $request->user()->update([
            'name' => $name,
            'username' => $username,
            'email' => $email,
        ]);

        $message = "profile updated";

        return redirect()->route('view_user_profile')->with('status', $message);
    }
}
