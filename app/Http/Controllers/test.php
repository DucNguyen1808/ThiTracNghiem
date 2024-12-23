<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class test extends Controller
{
    public function index()
    {
      // session()->put('1', '100');
    //
      $value = Cache::get('my_variable', 'default_value');
      dd($value);
    }
}
