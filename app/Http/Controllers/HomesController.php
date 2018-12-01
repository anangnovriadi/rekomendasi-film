<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function view() {
        return view('front.home-film');
    }
}
