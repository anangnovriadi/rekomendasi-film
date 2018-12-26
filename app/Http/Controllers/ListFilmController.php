<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Film;

class ListFilmController extends Controller
{
    public function view() {
        $all = Film::all();
        return view('front.list-film', compact('all'));
    }
}