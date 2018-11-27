<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sastrawi\Tokenizer\TokenizerFactory;
use Wamania\Snowball\English;
use App\Model\User;
use DB;
use BigShark\SQLToBuilder\BuilderClass;
use voku\helper\StopWords;
use App\Http\Controllers\Admin\Stopword;
use Nadar\Stemming\Stemm;

// SELECT parent.id_film, sum(parent.tf_idf_kuadrat) FROM tb_tf_idf AS tb_tf_idf JOIN tb_tf_idf AS parent ON parent.id_term = tb_tf_idf.id_term WHERE tb_tf_idf.id_user = 1 AND parent.id_film >= 1 GROUP BY parent.id_film

class HomeController extends Controller
{
    // public function index() 
    // {
    //     $stem = new English;
    //     $stem = $stem->stem('loved');
    //     // $ii = $this->mapArray(2, 2);
    //     $collection = collect([1, 2, 3, 4, 5]);
    //     $coll = collect([2, 4, 3, 1, 6]);

    //     // $multiplied = $collection->map(function($item, $key) {
    //     //     return $item * $item;
    //     // });

    //     $multiplied = $collection->combine($coll)->map(function($item, $key) {
    //         return $item * $key;
    //     });

    //     $get = DB::select('SELECT tf from tb_tf_idf WHERE id_user >= ?', array(1));
    //     // dd(collect($get));
    //     // $multiplied = $this->mapArray($collection->map());
    //     $getk = collect($get);

    //     // $total = $getk->reduce(function ($carry, $item) {
    //     //     return $carry;
    //     // });
    //     $mul = $getk->pluck('tf')->map(function($item, $key) {
    //         return $item * 2;
    //     });

    //     dd($mul);
    //     // print_r($multiplied->all());
    // }

    public function index() {
        $qTerm = DB::select('SELECT parent.id_film, sum(parent.tf_idf_kuadrat) AS tfidf FROM tb_tf_idf AS tb_tf_idf JOIN tb_tf_idf AS parent ON parent.id_term = tb_tf_idf.id_term WHERE tb_tf_idf.id_user = 1 AND parent.id_film >= 1 GROUP BY parent.id_film');
        // foreach($qTerm as $qTerms) {
        //     print_r($qTerms->tfidf);
        //     DB::insert("INSERT INTO tb_cosine(id, id_film, tf_idf_sum) values (null, '$qTerms->id_film', '$qTerms->tfidf')");
        // }
            
        $d = DB::select('SELECT SUM(tf_idf) FROM tb_tf_idf GROUP BY id_film > 1');
        $d = collect($d);
        $d = $d->pluck('SUM(tf_idf)');

        $qTerm = collect($qTerm);
        $qTerm = $qTerm->pluck('tfidf');

        $q = DB::select('SELECT tf_idf from tb_tf_idf WHERE id_user >= ?', array(1));
        $q = collect($q);
        $q = $q->pluck('tf_idf');
        
        $com = $qTerm->combine($d);
        $com->all();

        $cos = $com->map(function ($item, $key) {
            $q = DB::select('SELECT tf_idf from tb_tf_idf WHERE id_user >= ?', array(1));
            $q = collect($q);
            $q = $q->pluck('tf_idf');

            $q = $q->pipe(function ($q) {
                return $q->sum();
            });

            return $item / ($q * $key);

            // DB::select("SELECT tf_cosine from tb_tf_idf WHERE id_user = '$df'");
        });

        $keyCos = $cos->keys();
        // dd($keyCos);

        foreach($keyCos as $coss) {
            $cc = DB::select("SELECT id_film FROM tb_cosine WHERE tf_idf_sum = '$coss'");
            print_r($cc);

            foreach($cc as $ccs) {
                $ccf = DB::select("SELECT * FROM tb_film WHERE id = '$ccs->id_film'");
                print_r($ccf);
            }
        }
        // dd($cos);

        // DB::select('SELECT tf_idf from tb_tf_idf WHERE id_user >= ?', array(1));
    }

    public function ff() {
        $get = DB::select('SELECT * FROM tb_tf_idf WHERE id_user = 1');
        foreach($get as $gets) {
            $user = $gets->id_term;
            return $user;
            print_r($user);
        }
    }

    public function uu() {
        
    }

    public function mapArray($item, $key) {
        return $item * 2;
    }

    public function getUser() {
        $user = DB::select('SELECT * from tb_users WHERE id = ?', array(1));

        foreach($user as $users) {
            $id = $users->id;
        }

        return $id;
    }

    public function getFilm() {
        $film = DB::select('SELECT * from tb_film');

        return $film;
    }

    public function getIdFilm() {
        $film = DB::select('SELECT * from tb_film');
        $tokenisasi = new TokenizerFactory;
        $tokenizer = $tokenisasi->createDefaultTokenizer();

        foreach($film as $films) {
           $id_film = $tokenizer->tokenize($films->id);  
        }

        return $id_film;
    }

    public function mergeUser() {
        $tokenisasi = new TokenizerFactory;
        $tokenizer = $tokenisasi->createDefaultTokenizer();
        
        $user = DB::select('SELECT * from tb_users WHERE id = ?', array(1));

        foreach($user as $users) {
            $nama_film = $tokenizer->tokenize($users->nama_film_liked);
            $genre_film = $tokenizer->tokenize($users->genre_film_liked);
            
            $mergeAll = array_merge($nama_film, $genre_film);
        }

        return $mergeAll;
    }

    public function toTfUser() {
        $getAll = new HomeController();
        $term = $getAll->mergeUser();
        $id_user = $getAll->getUser();

        foreach($term as $terms) {
            DB::insert('INSERT INTO tb_terms(id, nama_term, df, idf) values (?, ?, ?, ?)', [null, $terms, 0, 0]);
            $getIdTerm = DB::select('SELECT * from tb_terms WHERE nama_term = ?', array($terms));

            foreach($getIdTerm as $getIdTerms) {
                $id_term = $getIdTerms->id;
            }

            DB::insert('INSERT INTO tb_tf_idf(id, id_film, id_user, id_term, tf, tf_idf, tf_idf_kuadrat) values(?, ?, ?, ?, ?, ?, ?)', [null, 0, $id_user, $id_term, 1, 0, 0]);
        }
    }

    public function toTermTf() {
        $getAll = new HomeController();
        $term = $getAll->mergeUser();
        $id_user = $getAll->getUser();
        $getFilm = $getAll->getFilm();
        $getAll->toTfUser();

        foreach($getFilm as $allFilm) {
            $tokenisasi = new TokenizerFactory;
            $tokenizer = $tokenisasi->createDefaultTokenizer();
            
            $id_film = $allFilm->id;
            $deskripsi_film = $allFilm->deskripsi_film;
            $termFilm = $tokenizer->tokenize($deskripsi_film);
            foreach($termFilm as $terms) {
                if(strlen($terms) !== 0) {
                    $cekTerm = DB::table('tb_terms')->where('nama_term', '=', $terms)->count();
    
                    if($cekTerm == 0) {
                        $term = DB::insert('INSERT INTO tb_terms(id, nama_term, df, idf) values (?, ?, ?, ?)', [null, $terms, 0, 0]);
                        $getIdTerm = DB::select('SELECT * from tb_terms WHERE nama_term = ?', array($terms));
    
                        foreach($getIdTerm as $getIdTerms) {
                            $id_term = $getIdTerms->id;
                        }
    
                        DB::insert('INSERT INTO tb_tf_idf(id, id_film, id_user, id_term, tf, tf_idf, tf_idf_kuadrat) values(?, ?, ?, ?, ?, ?, ?)', [null, $id_film, 0, $id_term, 1, 0, 0]);
                    } else {
                        $getIdTerm = DB::select('SELECT * from tb_terms WHERE nama_term = ?', array($terms));
    
                        foreach($getIdTerm as $getIdTerms) {
                            $id_term = $getIdTerms->id;
                        }

                        $cekTf = DB::table('tb_tf_idf')->where('id_term', '=', $id_term)->where('id_film', '=', $id_film)->count();
                        if($cekTf == 0) {
                            DB::insert('INSERT INTO tb_tf_idf(id, id_film, id_user, id_term, tf, tf_idf, tf_idf_kuadrat) values(?, ?, ?, ?, ?, ?, ?)', [null, $id_film, 0, $id_term, 1, 0, 0]);
                        } else {
                            $getTf = DB::select('SELECT * from tb_tf_idf WHERE id_term = ? AND id_film = ?', array($id_term, $id_film));

                            foreach($getTf as $tf) {
                                $frekuensi = $tf->tf;
                                $id_tf = $tf->id;
                            }

                            $frekuensi = $frekuensi + 1;
                            $updateTf = DB::table('tb_tf_idf')->where('id', '=', $id_tf)->update(['tf' => $frekuensi, 'id_term' => $id_term]);
                        }
                    }
                }  
            }
        }
    }

    public function toDfIdf() {
        $term = DB::select('SELECT * FROM tb_terms');

        foreach($term as $terms) {
            $id_term = $terms->id;
            $df = DB::table('tb_tf_idf')->where('id_term', '=', $id_term)->count();
            $jmlFilm = DB::table('tb_film')->count();
            $jmlFilm = $jmlFilm + 1;
            $idf = log($jmlFilm / $df);

            DB::table('tb_terms')->where('id', $id_term)->update(['df' => $df, 'idf' => $idf]);
        }

        $getAll = new HomeController();
        print_r($getAll->toTfIdf());
    }

    public function toTfIdf() {
        $tfIdf = DB::select('SELECT * FROM tb_tf_idf');

        foreach($tfIdf as $tfIdfs) {
            $id_terms = $tfIdfs->id_term;
            $tf = $tfIdfs->tf;
            $term = DB::table('tb_terms')->where('id', $id_terms)->get();
            
            foreach($term as $terms) {
                $idf = $terms->idf;
                $tfIdf = $tf * $idf;
                DB::table('tb_tf_idf')->where('id_term', $id_terms)->where('tf', $tf)->update(['tf_idf' => $tfIdf]);
            }
        }
    }

    public function toTfIdfKuadrat() {
        $tfIdf = DB::select('SELECT * FROM tb_tf_idf');

        foreach($tfIdf as $tfIdfs) {
            $tfIdf = $tfIdfs->tf_idf;
            $id_term = $tfIdfs->id_term;
            $tf = $tfIdfs->tf;
            $tfIdfKuadrat = $tfIdf * $tfIdf;

            DB::table('tb_tf_idf')->where('id_term', $id_term)->where('tf', $tf)->update(['tf_idf_kuadrat' => $tfIdfKuadrat]);
        }
    }
}