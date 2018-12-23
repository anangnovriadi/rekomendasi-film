<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Sastrawi\Tokenizer\TokenizerFactory;
use DB;

class HomesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view()
    {
        $countTable = DB::table('terms')->count();

        if ($countTable > 1) {
            $id_user = $this->getUser();

            $d = DB::select('SELECT SUM(tf_idf) FROM tf_idfs WHERE id_film >= 1 GROUP BY id_film');
            $d = collect($d);
            $d = $d->pluck('SUM(tf_idf)');

            $qTerm = collect($qTerm);

            $q = DB::select('SELECT tf_idf from tf_idfs WHERE id_user >= ?', array($id_user));
            $q = collect($q);
            $q = $q->pluck('tf_idf');

            $com = $d->combine($qTerm);

            $cos = $com->map(function ($item, $key) {
                $id_user = $this->getUser();

                $q = DB::select('SELECT tf_idf from tf_idfs WHERE id_user >= ?', array($id_user));
                $q = collect($q);
                $q = $q->pluck('tf_idf');

                $q = $q->pipe(function ($q) {
                    return $q->sum();
                });

                $i = collect($item);
                return $key / ($q * $i['tfidf']);
            });

            $keyCos = $cos->keys();

            foreach ($keyCos as $coss) {
                $cc = DB::select("SELECT id_film FROM coss WHERE tf_idf_sum_doc = '$coss'");

                foreach ($cc as $ccs) {
                    $all = DB::select("SELECT * FROM films WHERE id = '$ccs->id_film'");
                }
            }

            $toFront = $keyCos->map(function ($item, $key) {
                $cc = DB::select("SELECT id_film FROM coss WHERE tf_idf_sum_doc = '$item'");
                return $cc;
            });

            $toFrontW = $toFront->map(function ($item, $key) {
                return $item[0];
            });

            $to = $toFrontW->pluck('id_film');

            $toFrontZ = $to->map(function ($item, $key) {
                $all = DB::select("SELECT * FROM films WHERE id = '$item'");
                return $all;
            });

            $sort = $toFrontZ->sort();
            $take = $toFrontZ->take(5);

            return view('front.home-film', compact('take'));
        } else {
            $id_user = $this->getUser();

            $this->toTfIdfKuadrat();
            $qTerm = DB::select("SELECT parent.id_film, sum(parent.tf_idf_kuadrat) AS tfidf FROM tf_idfs AS tf_idfs JOIN tf_idfs AS parent ON parent.id_term = tf_idfs.id_term WHERE tf_idfs.id_user = '$id_user' AND parent.id_film >= 1 GROUP BY parent.id_film");

            foreach ($qTerm as $qTerms) {
                DB::insert("INSERT INTO cosines(id, id_film, tf_idf_sum) values (null, '$qTerms->id_film', '$qTerms->tfidf')");
            }

            $d = DB::select('SELECT SUM(tf_idf) FROM tf_idfs WHERE id_film >= 1 GROUP BY id_film');
            $d = collect($d);
            $d = $d->pluck('SUM(tf_idf)');

            $qTerm = collect($qTerm);

            $q = DB::select('SELECT tf_idf from tf_idfs WHERE id_user >= ?', array($id_user));
            $q = collect($q);
            $q = $q->pluck('tf_idf');

            $com = $d->combine($qTerm);

            $cos = $com->map(function ($item, $key) {
                $id_user = $this->getUser();

                $q = DB::select('SELECT tf_idf from tf_idfs WHERE id_user >= ?', array($id_user));
                $q = collect($q);
                $q = $q->pluck('tf_idf');

                $q = $q->pipe(function ($q) {
                    return $q->sum();
                });

                $i = collect($item);

                DB::insert("INSERT INTO coss(id, id_film, tf_idf_sum_doc) values (null, '$i[id_film]', '$key')");
                return $key / ($q * $i['tfidf']);
            });

            $keyCos = $cos->keys();

            foreach ($keyCos as $coss) {
                $cc = DB::select("SELECT id_film FROM coss WHERE tf_idf_sum_doc = '$coss'");

                foreach ($cc as $ccs) {
                    $all = DB::select("SELECT * FROM films WHERE id = '$ccs->id_film'");
                }
            }

            $toFront = $keyCos->map(function ($item, $key) {
                $cc = DB::select("SELECT id_film FROM coss WHERE tf_idf_sum_doc = '$item'");
                return $cc;
            });

            $toFrontW = $toFront->map(function ($item, $key) {
                return $item[0];
            });

            $to = $toFrontW->pluck('id_film');

            $toFrontZ = $to->map(function ($item, $key) {
                $all = DB::select("SELECT * FROM films WHERE id = '$item'");
                return $all;
            });

            $sort = $toFrontZ->sort();
            $take = $toFrontZ->take(5);

            return view('front.home-film', compact('take'));
        }
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
            $mergeAll = array_merge($nama_film, $genre_film);
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

            $mergeAll = array_merge($nama_film, $genre_film);
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