<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sastrawi\Tokenizer\TokenizerFactory;
use Wamania\Snowball\English;
use App\Model\Film;

class AllFilmController extends Controller
{
    public function index() {
        $all = Film::all();
        return view('front.all-film', compact('all'));
    }
}