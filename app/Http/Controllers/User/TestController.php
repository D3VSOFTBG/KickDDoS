<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Method;
use App\Models\Server;
use Illuminate\Http\Request;
use Spatie\Ssh\Ssh;

class TestController extends Controller
{
    function render()
    {
        $methods = Method::all();

        $data = [
            'methods' => $methods,
        ];

        return view('user.test', $data);
    }
    function post(Request $request)
    {
        $method = Method::findOrFail($request->method_id);

        $server = Server::findOrFail($method->id);

        $process = Ssh::create($server->username, $server->host, $server->port)->execute($method->command);

        if($process->isSuccessful())
        {
            return back()->with('ok', 1);
        }
        else
        {
            return back()->withError('Error');
        }
    }
}
