<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Server;
use Illuminate\Http\Request;

class ServersController extends Controller
{
    function render()
    {
        $servers = Server::orderBy('id', 'DESC')->paginate(setting('PAGINATION'));

        $data = [
            'servers' => $servers,
        ];

        return view('admin.servers', $data);
    }
    function create(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'host' => 'required|unique:servers',
            'port' => 'required|integer',
        ]);

        $server = new Server();
        $server->username = $request->username;
        $server->host = $request->host;
        $server->port = $request->port;
        $server->save();

        return back();
    }
    function delete(Request $request)
    {
        Server::findOrFail($request->id)->delete();
        return back();
    }
}
