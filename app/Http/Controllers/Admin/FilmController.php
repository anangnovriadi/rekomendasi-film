<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Film;

class FilmController extends Controller
{
    public function index() {
        return view('admin.film.view');
    }

    public function add() {
        return view('admin.film.add');
    }

    public function create(Request $request) {
        $this->validate($request, [
            'nama_film' => 'required',
            'genre' => 'required',
            'aktor_aktris' => 'required',
            'tahun' => 'required',
            'produksi' => 'required',
            'negara' => 'required',
            'deskripsi_film' => 'required'
        ]);
        
        Film::create([
            'nama_film' => $request->input('nama_film'),
            'genre' => $request->input('genre'),
            'aktor_aktris' => $request->input('aktor_aktris'),
            'tahun' => $request->input('tahun'),
            'produksi' => $request->input('produksi'),
            'negara' => $request->input('negara'),
            'deskripsi_film' => $request->input('deskripsi_film')
        ]);

        return redirect()->route('create.film');
    }
}