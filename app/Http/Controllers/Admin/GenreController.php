<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Genre;

class GenreController extends Controller
{
    public function view()
    {
        $genre = Genre::all();
        return view('admin.genre.view', compact('genre'));
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
