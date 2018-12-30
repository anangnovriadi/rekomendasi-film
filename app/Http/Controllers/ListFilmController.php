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

    public function detail($id) {
        $film = Film::find($id);

        return view('front.details-film', compact('film'));
    }
}