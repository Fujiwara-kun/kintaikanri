<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// コマンド「sail artisan make:controller TestController」で作成
class TestController extends Controller
{
    public function test(){
        return view('test');
    }//
}
