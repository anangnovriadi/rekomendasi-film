<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Genre;

class GenreController extends Controller
{
    public function view()
    {
        return view('admin.genre.view');
    }

    public function add()
    {
        return view('admin.genre.add');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'nama_genre' => 'required'
        ]);

        $genre = $request->input('nama_genre');

        Genre::create([
            'nama_genre' => $genre,
        ]);

        return redirect()->route('view.genre');
    }
}
