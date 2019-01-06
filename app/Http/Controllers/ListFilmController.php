<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Film;
use DB;

class ListFilmController extends Controller
{
    public function view() {
        $all = Film::paginate(8);
        return view('front.list-all-film', compact('all'));
    }

    public function detail($slug) {
        $film = DB::table('films')->where('nama_slug', $slug)->get();
        
        return view('front.details-film', compact('film'));
    }
}