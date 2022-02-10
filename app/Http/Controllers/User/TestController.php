<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Method;
use App\Models\Server;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Ssh\Ssh;

class TestController extends Controller
{
    function render()
    {
        $methods = Method::all();

        $test_count = Test::where('expire_at', '>' ,time())->count();

        $data = [
            'methods' => $methods,
            'test_count' => $test_count,
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
            $test = new Test();
            $test->user_id = Auth::user()->id;
            $test->expire_at = time() + $request->seconds;
            $test->save();

            return back()->with('ok', 1);
        }
        else
        {
            return back()->withError('Error');
        }
    }
}
