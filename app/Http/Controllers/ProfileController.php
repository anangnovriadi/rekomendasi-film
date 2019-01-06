<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Cosine;
use App\Model\Term;
use App\Model\Tf_idf;
use App\Model\Cos;
use App\Model\Film;
use DB;
use Nadar\Stemming\Stemm;
use voku\helper\StopWords;

class ProfileController extends Controller
{
    public function view()
    {
        $user = Auth::user();
        $nama_film = Film::all('nama_film')->pluck('nama_film')->toArray();
        $genre_film = Film::all('genre')->unique('genre')->pluck('genre')->toArray();

        return view('front.profile-film', compact('user', 'nama_film', 'genre_film'));
    }

    public function update(Request $request) 
    {
        Tf_idf::query()->truncate();
        Term::query()->truncate();
        Cosine::query()->truncate();
        Cos::query()->truncate();

        $stopword = new StopWords();
        $stopword = $stopword->getStopWordsFromLanguage('en');

        // Nama Film Liked
        $nama_film_liked = $request->input('nama_film_liked');
        $nama_film_liked = strtolower($nama_film_liked);
        $nama_film_liked = trim(preg_replace('/([^a-z0-9]+)/i', ' ', $nama_film_liked), '');

        foreach($stopword as &$stopwords) {
            $stopwords = '/\b' . preg_quote($stopwords, '/') . '\b/';
        }
        
        $nama_film_liked = preg_replace($stopword, '', $nama_film_liked);
        $nama_film_liked = str_replace($stopword, '', $nama_film_liked);
        $nama_film_liked = Stemm::stemPhrase($nama_film_liked, 'en');
        $nama_film_liked = trim(preg_replace('/\s+/', ' ', $nama_film_liked));

        // Genre Film Liked
        $genre_film_liked = $request->input('genre_film_liked');
        $genre_film_liked = strtolower($genre_film_liked);
        $genre_film_liked = trim(preg_replace('/([^a-z0-9]+)/i', ' ', $genre_film_liked), '');

        foreach($stopword as &$stopwords) {
            $stopwords = '/\b' . preg_quote($stopwords, '/') . '\b/';
        }
        
        $genre_film_liked = preg_replace($stopword, '', $genre_film_liked);
        $genre_film_liked = str_replace($stopword, '', $genre_film_liked);
        $genre_film_liked = Stemm::stemPhrase($genre_film_liked, 'en');
        $genre_film_liked = trim(preg_replace('/\s+/', ' ', $genre_film_liked));

        $id = $request->input('id');
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');

        DB::table('users')->where('id', $id)->update(
            [
                'firstname' => $firstname,
                'lastname' => $lastname,
                'nama_film_liked' => $nama_film_liked, 
                'genre_film_liked' => $genre_film_liked
            ]
        );

        return redirect()->route('home');
    }
}
