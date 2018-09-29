<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sastrawi\Tokenizer\TokenizerFactory;
use Wamania\Snowball\English;
use App\Model\User;
use DB;

class HomeController extends Controller
{
    public function index() 
    {
        $stem = new English;
        $stem = $stem->stem('loved');
        print_r($stem.'<br>');

        $tokenisasi = new TokenizerFactory;
        $tokenizer = $tokenisasi->createDefaultTokenizer();
        
        $userAll = User::all('nama_film_liked', 'genre_film_liked');
        // $res = DB::select('SELECT genre_film_liked from tb_users WHERE id = ?', array(1));
        $res = DB::select('SELECT * from tb_users WHERE id = ?', array(1));

        foreach($res as $user) {
            $nama_film = $tokenizer->tokenize($user->nama_film_liked);
            $genre_film = $tokenizer->tokenize($user->genre_film_liked);
            
            $mer = array_merge($nama_film, $genre_film);
            print_r($mer);
        }
    }
}
