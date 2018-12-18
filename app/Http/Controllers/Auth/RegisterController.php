<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Nadar\Stemming\Stemm;
use voku\helper\StopWords;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showRegistrationForm() {
        return view('front.auth.register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'password' => 'required',
            'nama_film_liked' => 'required',
            'genre_film_liked' => 'required'
        ]);
    }

    protected function create(array $data)
    {
        $stopword = new StopWords();
        $stopword = $stopword->getStopWordsFromLanguage('en');

        // Nama Film Liked
        $nama_film_liked = $data['nama_film_liked'];
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
        $genre_film_liked = $data['genre_film_liked'];
        $genre_film_liked = strtolower($genre_film_liked);
        $genre_film_liked = trim(preg_replace('/([^a-z0-9]+)/i', ' ', $genre_film_liked), '');

        foreach($stopword as &$stopwords) {
            $stopwords = '/\b' . preg_quote($stopwords, '/') . '\b/';
        }
        
        $genre_film_liked = preg_replace($stopword, '', $genre_film_liked);
        $genre_film_liked = str_replace($stopword, '', $genre_film_liked);
        $genre_film_liked = Stemm::stemPhrase($genre_film_liked, 'en');
        $genre_film_liked = trim(preg_replace('/\s+/', ' ', $genre_film_liked));

        // Deskripsi Film Liked
        // $deskripsi_film_liked = $data['deskripsi_film_liked'];
        // $deskripsi_film_liked = strtolower($deskripsi_film_liked);
        // $deskripsi_film_liked = trim(preg_replace('/([^a-z0-9]+)/i', ' ', $deskripsi_film_liked), '');

        // foreach($stopword as &$stopwords) {
        //     $stopwords = '/\b' . preg_quote($stopwords, '/') . '\b/';
        // }
        
        // $deskripsi_film_liked = preg_replace($stopword, '', $deskripsi_film_liked);
        // $deskripsi_film_liked = str_replace($stopword, '', $deskripsi_film_liked);
        // $deskripsi_film_liked = Stemm::stemPhrase($deskripsi_film_liked, 'en');
        // $deskripsi_film_liked = trim(preg_replace('/\s+/', ' ', $deskripsi_film_liked));

        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'nama_film_liked' => $nama_film_liked,
            'genre_film_liked' => $genre_film_liked
        ]);
    }
}
