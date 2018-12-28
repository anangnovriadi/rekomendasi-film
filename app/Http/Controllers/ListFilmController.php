<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Film;

class ListFilmController extends Controller
{
    public function view() {
        $all = Film::paginate(4);
        return view('front.list-all-film', compact('all'));
    }
}