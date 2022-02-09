<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Method;
use App\Rules\Layer;
use Illuminate\Http\Request;

class MethodsController extends Controller
{
    function render()
    {
        $methods = Method::orderBy('id', 'DESC')->paginate(setting('PAGINATION'));

        $data = [
            'methods' => $methods,
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
        ]);

        $method = new Method();
        $method->name = $request->name;
        $method->layer = $request->layer;
        $method->command = $request->command;
        $method->save();

        return back();
    }
    function delete(Request $request)
    {
        Method::findOrFail($request->id)->delete();
        return back();
    }
}
