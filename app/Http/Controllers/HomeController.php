<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function render()
    {
        if(Cache::has('server_count'))
        {
            $server_count = Cache::get('server_count');
        }
        else
        {
            $server_count = Cache::forever('server_count', Server::count());
        }

        if(Cache::has('user_count'))
        {
            $user_count = Cache::get('user_count');
        }
        else
        {
            $user_count = Cache::forever('user_count', User::count());
        }

        $data = [
            'user_count' => $user_count,
            'server_count' => $server_count,
        ];

        return view('home', $data);
    }
}
