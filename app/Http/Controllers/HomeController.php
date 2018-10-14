<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sastrawi\Tokenizer\TokenizerFactory;
use Wamania\Snowball\English;
use App\Model\User;
use DB;
use BigShark\SQLToBuilder\BuilderClass;

class HomeController extends Controller
{
    public function index() 
    {
        $stem = new English;
        $stem = $stem->stem('loved');

        $getAll = new HomeController();
        print_r($getAll->toTermTf());
        print_r($getAll->toDfIdf());
        print_r($getAll->toTfIdf());
        print_r($getAll->toTfIdfKuadrat());
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