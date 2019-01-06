<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Film;
use Nadar\Stemming\Stemm;
use voku\helper\StopWords;

class FilmController extends Controller
{
    public function add()
    {
        return view('admin.film.add');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'nama_film' => 'required',
            'genre' => 'required',
            'aktor_aktris' => 'required',
            'tahun' => 'required',
            'produksi' => 'required',
            'negara' => 'required',
            'deskripsi_film' => 'required',
            'image_film' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $stopword = new StopWords();
        $stopword = $stopword->getStopWordsFromLanguage('en');
        
        // Nama Film
        $nama_film = $request->input('nama_film');
        $nama_film = strtolower($nama_film);
        $nama_film = trim(preg_replace('/([^a-z0-9]+)/i', ' ', $nama_film), '');

        foreach ($stopword as &$stopwords) {
            $stopwords = '/\b' . preg_quote($stopwords, '/') . '\b/';
        }

        $nama_film = preg_replace($stopword, '', $nama_film);
        $nama_film = str_replace($stopword, '', $nama_film);
        $nama_film = Stemm::stemPhrase($nama_film, 'en');
        $nama_film = trim(preg_replace('/\s+/', ' ', $nama_film));

        // Genre
        $genre = $request->input('genre');
        $genre = strtolower($genre);
        $genre = trim(preg_replace('/([^a-z0-9]+)/i', ' ', $genre), '');

        $genre = preg_replace($stopword, '', $genre);
        $genre = str_replace($stopword, '', $genre);
        $genre = Stemm::stemPhrase($genre, 'en');
        $genre = trim(preg_replace('/\s+/', ' ', $genre));

        // Aktor/Aktris
        $aktor_aktris = $request->input('aktor_aktris');
        $aktor_aktris = strtolower($aktor_aktris);
        $aktor_aktris = trim(preg_replace('/([^a-z0-9]+)/i', ' ', $aktor_aktris), '');

        $aktor_aktris = preg_replace($stopword, '', $aktor_aktris);
        $aktor_aktris = str_replace($stopword, '', $aktor_aktris);
        $aktor_aktris = Stemm::stemPhrase($aktor_aktris, 'en');
        $aktor_aktris = trim(preg_replace('/\s+/', ' ', $aktor_aktris));

        // Tahun
        $tahun = $request->input('tahun');
        $tahun = strtolower($tahun);
        $tahun = trim(preg_replace('/([^a-z0-9]+)/i', ' ', $tahun), '');

        $tahun = preg_replace($stopword, '', $tahun);
        $tahun = str_replace($stopword, '', $tahun);
        $tahun = Stemm::stemPhrase($tahun, 'en');
        $tahun = trim(preg_replace('/\s+/', ' ', $tahun));

        // Produksi
        $produksi = $request->input('produksi');
        $produksi = strtolower($produksi);
        $produksi = trim(preg_replace('/([^a-z0-9]+)/i', ' ', $produksi), '');

        $produksi = preg_replace($stopword, '', $produksi);
        $produksi = str_replace($stopword, '', $produksi);
        $produksi = Stemm::stemPhrase($produksi, 'en');
        $produksi = trim(preg_replace('/\s+/', ' ', $produksi));

        // Negara
        $negara = $request->input('negara');
        $negara = strtolower($tahun);
        $negara = trim(preg_replace('/([^a-z0-9]+)/i', ' ', $negara), '');

        $negara = preg_replace($stopword, '', $negara);
        $negara = str_replace($stopword, '', $negara);
        $negara = Stemm::stemPhrase($negara, 'en');
        $negara = trim(preg_replace('/\s+/', ' ', $negara));

        // Deskripsi Film
        $deskripsi_film = $request->input('deskripsi_film');
        $deskripsi_film = strtolower($deskripsi_film);
        $deskripsi_film = trim(preg_replace('/([^a-z0-9]+)/i', ' ', $deskripsi_film), '');

        $deskripsi_film = preg_replace($stopword, '', $deskripsi_film);
        $deskripsi_film = str_replace($stopword, '', $deskripsi_film);
        $deskripsi_film = Stemm::stemPhrase($deskripsi_film, 'en');
        $deskripsi_film = trim(preg_replace('/\s+/', ' ', $deskripsi_film));

        // Slug
        $slug_name = str_slug($nama_film, '-');

        if ($request->hasFile('image_film')) {
            $image = $request->file('image_film');
            $name = str_slug($image->getClientOriginalName()).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('\admin\images');
            $imagePath = $destinationPath. "/". $name;
            $image->move($destinationPath, $name);
        }

        Film::create([
            'nama_film' => $nama_film,
            'nama_slug' => $slug_name,
            'genre' => $genre,
            'aktor_aktris' => $aktor_aktris,
            'tahun' => $tahun,
            'produksi' => $produksi,
            'negara' => $negara,
            'deskripsi_film' => $deskripsi_film,
            'image_film' => 'images/'.$name,
            'rating' => '0',
            'kelas' => ''
        ]);

        return redirect()->route('view.film');
    }

    public function view()
    {
        $film = Film::all();

        return view('admin.film.view', compact('film'));
    }
}