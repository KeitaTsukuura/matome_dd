<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GearController extends Controller
{
    public function index()
    {
        return view('gears.index');
    }
}
