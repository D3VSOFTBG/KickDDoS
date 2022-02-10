<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Method;
use Illuminate\Http\Request;

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
}
