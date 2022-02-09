<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Rules\TrueOrFalse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    function render()
    {
        $users = User::orderBy('id', 'DESC')->paginate(setting('PAGINATION'));

        $data = [
            'users' => $users,
        ];

        return view('admin.users', $data);
    }
    function create(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'is_admin' => [
                'required',
                new TrueOrFalse(),
            ],
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_admin = $request->is_admin;

        if($request->password == $request->password_confirmation)
        {
            $user->password = Hash::make($request->password);
        }
        else
        {
            return back()->withErrors('Your passwords do not match.');
        }

        $user->save();

        return back();
    }
    function delete(Request $request)
    {
        User::findOrFail($request->id)->delete();
        return back();
    }
    function edit(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'is_admin' => [
                'required',
                new TrueOrFalse(),
            ],
        ]);

        $user = User::findOrFail($request->id);

        if($request->email != $user->email)
        {
            $request->validate([
                'email' => 'required|email|max:255|unique:users',
            ]);
            $user->email = $request->email;
            $user->email_verified_at = NULL;
        }

        if(isset($request->password) || isset($request->password_confirmation))
        {
            $request->validate([
                'password' => 'required|min:8',
                'password_confirmation' => 'required|min:8',
            ]);
            if($request->password == $request->password_confirmation)
            {
                $user->password = Hash::make($request->password);
            }
            else
            {
                return back()->withErrors('Your passwords do not match.');
            }
        }

        $user->name = $request->name;
        $user->is_admin = $request->is_admin;
        $user->save();

        return back();
    }
}
