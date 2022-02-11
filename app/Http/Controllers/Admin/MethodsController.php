<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Method;
use App\Models\Server;
use App\Rules\Layer;
use Illuminate\Http\Request;

class MethodsController extends Controller
{
    function render()
    {
        $methods = Method::orderBy('id', 'DESC')->paginate(setting('PAGINATION'));
        $servers = Server::all();

        $data = [
            'methods' => $methods,
            'servers' => $servers,
        ];

        return view('admin.methods', $data);
    }
    function create(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:methods',
            'layer' => [
                'required',
                new Layer(),
            ],
            'command' => 'required',
            'server_id' => 'required|integer',
        ]);

        $method = new Method();
        $method->name = $request->name;
        $method->layer = $request->layer;
        $method->command = $request->command;
        $method->server_id = $request->server_id;
        $method->save();

        return back();
    }
    function delete(Request $request)
    {
        Method::findOrFail($request->id)->delete();
        return back();
    }
}
