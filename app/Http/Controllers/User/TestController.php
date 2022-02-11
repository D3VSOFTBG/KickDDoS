<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Method;
use App\Models\Server;
use App\Models\Test;
use App\Rules\Host;
use App\Rules\Port;
use App\Rules\Seconds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        $request->validate([
            'host' => [
                'required',
                new Host(),
            ],
            'port' => [
                'required',
                'integer',
                new Port(),
            ],
            'seconds' => [
                'required',
                'integer',
                new Seconds(),
            ],
        ]);
        $method = Method::findOrFail($request->method_id);

        $server = Server::findOrFail($method->server_id);

        $command = str_replace(['{host}', '{port}', '{seconds}'], [$request->host, $request->port, $request->seconds], $method->command);

        $process = Ssh::create($server->username, $server->host, $server->port)->execute($command);

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
