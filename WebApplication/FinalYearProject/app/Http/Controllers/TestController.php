<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        \Log::info('TestController test method called');
        return 'Test route working!';
    }
    public function login()
    {
        return view('login');
    }
} 