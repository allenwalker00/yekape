<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function link($id = null)
    {
        return view('index');
    }
}
