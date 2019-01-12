<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Film;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function search(Request $request) 
    {
        $query = $request->input('qry');
        $film = Film::where('nama_film', 'LIKE', '%'.$query.'%')->get();

        return view('front.result-search', compact('film'))->withQuery($query);
    }
}
