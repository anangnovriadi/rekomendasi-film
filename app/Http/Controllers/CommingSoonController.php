<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Film;

class CommingSoonController extends Controller
{
    public function view() {
        $coming = Film::where('coming', 'yes')->get();

        return view('front.coming-film', compact('coming'));
    }
}
