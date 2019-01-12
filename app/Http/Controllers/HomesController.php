<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Sastrawi\Tokenizer\TokenizerFactory;
use DB;
use App\Model\Film;

class HomesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view()
    {
        set_time_limit(0);
        $countTable = DB::table('terms')->count();

        $id_user = $this->getUser();
        if($countTable < 1) {
            $this->toTfIdfKuadrat();
        }

        $d = DB::select('SELECT SUM(tf_idf) FROM tf_idfs WHERE id_film >= 1 GROUP BY id_film');
        $d = collect($d);
        $d = $d->pluck('SUM(tf_idf)');

        $qTerm = DB::select("SELECT parent.id_film, sum(parent.tf_idf_kuadrat) AS tfidf FROM tf_idfs AS tf_idfs JOIN tf_idfs AS parent ON parent.id_term = tf_idfs.id_term WHERE tf_idfs.id_user = '$id_user' AND parent.id_film >= 1 GROUP BY parent.id_film");
        $qTerm = collect($qTerm);

        $q = DB::select('SELECT id_film, tf_idf from tf_idfs WHERE id_user >= ?', array($id_user));
        $q = collect($q);

        $qFilm = DB::select('SELECT id_film, SUM(tf_idf) AS tf_idf FROM tf_idfs WHERE id_film >= 1 GROUP BY id_film');
        $vFilm = DB::select('SELECT id_film FROM tf_idfs WHERE id_film >= 1 GROUP BY id_film');
        $qTerm = DB::select("SELECT parent.id_film, sum(parent.tf_idf_kuadrat) AS tfidf FROM tf_idfs AS tf_idfs JOIN tf_idfs AS parent ON parent.id_term = tf_idfs.id_term WHERE tf_idfs.id_user = '$id_user' AND parent.id_film >= 1 GROUP BY parent.id_film");
        if ($countTable > 1) {
            $getF = DB::select('SELECT id_film FROM c_products');
            foreach ($getF as $get) {
                $qTerm = DB::select("SELECT parent.id_film, sum(parent.tf_idf_kuadrat) AS tfidf FROM tf_idfs AS tf_idfs JOIN tf_idfs AS parent ON parent.id_term = tf_idfs.id_term WHERE tf_idfs.id_user = '$id_user' AND parent.id_film >= 1 GROUP BY parent.id_film");
                $qTerm = collect($qTerm);
            }
        } else {
            foreach ($vFilm as $vFilms) {
                DB::insert("INSERT INTO c_products(id, id_film, tf_idf) values (null, '$vFilms->id_film', 0)");
                DB::insert("INSERT INTO d_products(id, id_film, tf_idf) values (null, '$vFilms->id_film', 0)");
            }

            $getF = DB::select('SELECT id_film FROM c_products');
            foreach ($getF as $get) {
                $qTerm = DB::select("SELECT parent.id_film, sum(parent.tf_idf_kuadrat) AS tfidf FROM tf_idfs AS tf_idfs JOIN tf_idfs AS parent ON parent.id_term = tf_idfs.id_term WHERE tf_idfs.id_user = '$id_user' AND parent.id_film >= 1 GROUP BY parent.id_film");
                $qTerm = collect($qTerm);

                $qMap = $qTerm->map(function($item, $key) {
                    DB::table('c_products')->where('id_film', $item->id_film)->update(['tf_idf' => $item->tfidf]);
                });
            }
        }
        
        $getCProduct = DB::select('SELECT tf_idf FROM c_products');
        $getCProduct = collect($getCProduct);
        $getCProduct = $getCProduct->pluck('tf_idf');

        $qFilm = collect($qFilm);
        
        $cos = $qFilm->map(function($item, $key) {
            $id_user = $this->getUser();

            $q = DB::select('SELECT tf_idf from tf_idfs WHERE id_user >= ?', array($id_user));
            $q = collect($q);
            $q = $q->pluck('tf_idf');

            $q = $q->pipe(function ($q) {
                return $q->sum();
            });

            $q = sqrt($q);
            $tfidf = sqrt($item->tf_idf);

            $tCproduct = $q * $tfidf;
        
            DB::table('d_products')->where('id_film', $item->id_film)->update(['tf_idf' => $tCproduct]);

            return $item;
        }); 

        $getCosine = DB::select('SELECT c_products.id_film, (c_products.tf_idf / d_products.tf_idf) AS total_cosine FROM c_products JOIN d_products ON c_products.id_film = d_products.id_film ORDER by total_cosine DESC');
        $getCosine = collect($getCosine);

        $toFront = $getCosine->map(function($item) {
            $getCosineFix = DB::select("SELECT * FROM films WHERE id = '$item->id_film'");

            return $getCosineFix;
        });

        // $take = $toFront->take(2);
        $take = $toFront->take(4);
        $takeGenre = $toFront->sortKeysDesc()->take(3);
        $pop = DB::select("SELECT * FROM films ORDER BY id DESC"); 
        $pop = collect($pop);
        $pop = $pop->take(5);
        $popOne = $pop->take(1);
        
        // return view('front.home-film', compact('take', 'takeGenre', 'popOne', 'pop'));
        return view('front.home-film', compact('take', 'popOne', 'pop'));
    }

    // mendapatkan id user
    public function getUser()
    {
        $id_user = Auth::id();
        return $id_user;
    }

    // mendapatkan semua film
    public function getFilm()
    {
        $film = DB::select('SELECT * from films');
        return $film;
    }

    // gabung antara user dan film
    public function mergeUser()
    {
        $tokenisasi = new TokenizerFactory;
        $tokenizer = $tokenisasi->createDefaultTokenizer();

        $id_user = $this->getUser();
        $user = DB::select('SELECT * from users WHERE id = ?', array($id_user));

        foreach ($user as $users) {
            $nama_film = $tokenizer->tokenize($users->nama_film_liked);
            $genre_film = $tokenizer->tokenize($users->genre_film_liked);
            $aktor = $tokenizer->tokenize($users->aktor_aktris_liked);
            $mergeAll = array_merge($nama_film, $genre_film, $aktor);
        }

        return $mergeAll;
    }

    // menambahkan data term, tf-idf(ke dalam tabel terms, tf_idfs) dari function mergeUser(untuk perulangan) dan getUser
    public function toTfUser()
    {
        $term = $this->mergeUser();
        $id_user = $this->getUser();

        foreach ($term as $terms) {
            DB::insert('INSERT INTO terms(id, nama_term, df, idf) values (?, ?, ?, ?)', [null, $terms, 0, 0]);
            $getIdTerm = DB::select('SELECT * from terms WHERE nama_term = ?', array($terms));

            foreach ($getIdTerm as $getIdTerms) {
                $id_term = $getIdTerms->id;
            }

            DB::insert('INSERT INTO tf_idfs(id, id_film, id_user, id_term, tf, tf_idf, tf_idf_kuadrat) values(?, ?, ?, ?, ?, ?, ?)', [null, 0, $id_user, $id_term, 1, 0, 0]);
        }
    }

    // menambahkan data term, tf-idf(ke dalam tabel terms, tf_idfs) dari function getFilm, mergeUser(untuk perulangan) dan getUser
    public function toTermTf()
    {
        $term = $this->mergeUser();
        $id_user = $this->getUser();
        $getFilm = $this->getFilm();
        $this->toTfUser();

        foreach ($getFilm as $allFilm) {
            $tokenisasi = new TokenizerFactory;
            $tokenizer = $tokenisasi->createDefaultTokenizer();

            $id_film = $allFilm->id;
            $nama_film = $tokenizer->tokenize($allFilm->nama_film);
            $genre_film = $tokenizer->tokenize($allFilm->genre);
            $aktor_aktris = $tokenizer->tokenize($allFilm->aktor_aktris);

            $mergeAll = array_merge($nama_film, $genre_film, $aktor_aktris);
            foreach ($mergeAll as $terms) {
                if (strlen($terms) !== 0) {
                    $cekTerm = DB::table('terms')->where('nama_term', '=', $terms)->count();

                    if ($cekTerm == 0) {
                        $term = DB::insert('INSERT INTO terms(id, nama_term, df, idf) values (?, ?, ?, ?)', [null, $terms, 0, 0]);
                        $getIdTerm = DB::select('SELECT * from terms WHERE nama_term = ?', array($terms));

                        foreach ($getIdTerm as $getIdTerms) {
                            $id_term = $getIdTerms->id;
                        }

                        DB::insert('INSERT INTO tf_idfs(id, id_film, id_user, id_term, tf, tf_idf, tf_idf_kuadrat) values(?, ?, ?, ?, ?, ?, ?)', [null, $id_film, 0, $id_term, 1, 0, 0]);
                    } else {
                        $getIdTerm = DB::select('SELECT * from terms WHERE nama_term = ?', array($terms));

                        foreach ($getIdTerm as $getIdTerms) {
                            $id_term = $getIdTerms->id;
                        }

                        $cekTf = DB::table('tf_idfs')->where('id_term', '=', $id_term)->where('id_film', '=', $id_film)->count();
                        if ($cekTf == 0) {
                            DB::insert('INSERT INTO tf_idfs(id, id_film, id_user, id_term, tf, tf_idf, tf_idf_kuadrat) values(?, ?, ?, ?, ?, ?, ?)', [null, $id_film, 0, $id_term, 1, 0, 0]);
                        } else {
                            $getTf = DB::select('SELECT * from tf_idfs WHERE id_term = ? AND id_film = ?', array($id_term, $id_film));

                            foreach ($getTf as $tf) {
                                $frekuensi = $tf->tf;
                                $id_tf = $tf->id;
                            }

                            $frekuensi = $frekuensi + 1;
                            $updateTf = DB::table('tf_idfs')->where('id', '=', $id_tf)->update(['tf' => $frekuensi, 'id_term' => $id_term]);
                        }
                    }
                }
            }
        }
    }

    // update data df dan idf ke masing - masing id_term
    public function toDfIdf()
    {
        $this->toTermTf();
        $term = DB::select('SELECT * FROM terms');

        foreach ($term as $terms) {
            $id_term = $terms->id;
            $df = DB::table('tf_idfs')->where('id_term', '=', $id_term)->count();
            $jmlFilm = DB::table('films')->count();
            $jmlFilm = $jmlFilm + 1;
            $idf = log($jmlFilm / $df);

            DB::table('terms')->where('id', $id_term)->update(['df' => $df, 'idf' => $idf]);
        }
    }

    // update data tf-idf ke masing - masing id_term
    public function toTfIdf()
    {
        $this->toDfIdf();
        $tfIdf = DB::select('SELECT * FROM tf_idfs');

        foreach ($tfIdf as $tfIdfs) {
            $id_terms = $tfIdfs->id_term;
            $tf = $tfIdfs->tf;
            $term = DB::table('terms')->where('id', $id_terms)->get();

            foreach ($term as $terms) {
                $idf = $terms->idf;
                $tfIdf = $tf * $idf;
                DB::table('tf_idfs')->where('id_term', $id_terms)->where('tf', $tf)->update(['tf_idf' => $tfIdf]);
            }
        }
    }

    // update data tf-idf-kuadrat ke masing - masing id_term
    public function toTfIdfKuadrat()
    {
        $this->toTfIdf();
        $tfIdf = DB::select('SELECT * FROM tf_idfs');

        foreach ($tfIdf as $tfIdfs) {
            $tfIdf = $tfIdfs->tf_idf;
            $id_term = $tfIdfs->id_term;
            $tf = $tfIdfs->tf;
            $tfIdfKuadrat = $tfIdf * $tfIdf;

            DB::table('tf_idfs')->where('id_term', $id_term)->where('tf', $tf)->update(['tf_idf_kuadrat' => $tfIdfKuadrat]);
        }
    }
}