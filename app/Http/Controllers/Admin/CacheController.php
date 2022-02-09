<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CacheController extends Controller
{
    function render()
    {
        return view('admin.cache');
    }
    function flush()
    {
        Cache::flush();
        return back();
    }
}
