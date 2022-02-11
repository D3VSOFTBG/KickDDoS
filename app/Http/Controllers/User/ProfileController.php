<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    function render()
    {
        return view('user.profile');
    }
    function post(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->name;

        if($user->email != $request->email)
        {
            $request->validate([
                'email' => 'required|email|max:255|unique:users',
            ]);
            $user->email = $request->email;
            $user->email_verified_at = NULL;
        }

        if(isset($request->current_password))
        {
            if(Auth::validate(['email' => $user->email, 'password' => $request->current_password]))
            {
                $request->validate([
                    'new_password' => 'required|min:8',
                    'new_password_confirmation' => 'required|min:8',
                ]);
                if($request->new_password == $request->new_password_confirmation)
                {
                    $user->password = Hash::make($request->new_password);
                }
                else
                {
                    return back()->withErrors('Your passwords do not match.');
                }
            }
            else
            {
                return back()->withErrors('Your current password do not match.');
            }
        }

        $user->save();

        return back();
    }
}
