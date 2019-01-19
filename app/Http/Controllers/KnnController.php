<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Phpml\Classification\KNearestNeighbors;
use Phpml\Dataset\Demo\IrisDataset;
use Phpml\Dataset\ArrayDataset;
use Phpml\CrossValidation\RandomSplit;
use Phpml\CrossValidation\StratifiedRandomSplit;
use Phpml\FeatureSelection\SelectKBest;
use Phpml\Metric\Accuracy;
use Goutte\Client;
use DB;
use Nadar\Stemming\Stemm;
use voku\helper\StopWords;

class KnnController extends Controller
{
    // public function index() {
    //     // $classifier = new KNearestNeighbors($k=4);
    //     $dataset = new ArrayDataset(
    //         $samples = [[1], [2], [3], [4], [5], [6], [7], [8]],
    //         $targets = ['a', 'a', 'a', 'a', 'b', 'b', 'b', 'b']
    //     );
        

    //     $sample = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
    //     $labels = ['a', 'a', 'a', 'b', 'b', 'b'];

    //     // $classifier = new KNearestNeighbors();
    //     // $classifier->train($samples, $labels);

    //     // $irisDataset = new IrisDataset();

    //     $dataset = new IrisDataset();
    //     $selector = new SelectKBest(3);
    //     $selector->fit($samples = $sample, $labels);
    //     $selector->transform($samples);
    //     // $selector->scores();

    //     // dd($classifier->predict([3, 2]));

    //     $randomSplit = new RandomSplit($dataset, 0.2);

    //     dd($randomSplit);
    // }

    // public function index() {
    //     $knn = DB::select('SELECT c_products.id_film, ( d_products.tf_idf / c_products.tf_idf) 
    //             AS total_cosine,films.kelas FROM c_products 
    //                 JOIN d_products ON c_products.id_film = d_products.id_film 
    //                     JOIN films ON c_products.id_film = films.id ORDER BY total_cosine DESC LIMIT 8');

    //     $knn = collect($knn);
    //     $relevan = $knn->where('kelas', 'y')->count();
    //     $notRelevan = $knn->where('kelas', 't')->count();
    //     $precission = ($relevan / ($relevan + $notRelevan)) * 100;
    //     $recall = ($relevan / ($relevan + 0)) * 100;
    //     $accuracy = ($relevan + 0 / ($relevan + 0 + 5 + 0)) * 10;

    //     $fscore = 2 * ($precission * $recall / $precission + $recall) / 10;

    //     dd($precission, $recall, $accuracy, $fscore);
    // }

    public function index() {
        $totalFilm = DB::select('SELECT * FROM films');
        $totalFilm = collect($totalFilm)->count();

        $kOptimal = DB::select('SELECT k FROM `k_optimals` ORDER BY accuracy_k DESC, k DESC LIMIT 1');
        $kOptimal = collect($kOptimal);
        $kOptimal = $kOptimal->pluck('k');

        $kTrue = DB::select('SELECT jumlah FROM `kelas_selected`');
        $kTrue = collect($kTrue);
        $kTrue = $kTrue->pluck('jumlah');

        $tp = $kTrue[0];
        $fn = abs($kOptimal[0] - $tp);
        $fp = abs($kOptimal[0] - $fn);
        // $tn = $totalFilm - $fp;
        $tn = 100 - $fn;

        $precission = $tp / ($tp + $fp);
        $recall = $tp / ($tp + $fn);
        $accuracy = ($tp + $tn) / ($tp + $tn + $fp + $fn);
        $fscore = 2 * ($precission * $recall) / ($precission + $recall);


        dd($tp, $fp, $fn, $tn, $precission * 100, $recall * 100, $accuracy * 100, $fscore * 100);
    }

    // public function index() {
    //     $client = new Client();
    //     // $crawler = $client->request('GET', 'https://www.imdb.com/search/title?title_type=feature&num_votes=25000,&genres=adventure&sort=user_rating,desc&start=101&ref_=adv_nxt');
    //     // $crawler = $client->request('GET', 'https://www.imdb.com/search/title?title_type=feature&num_votes=25000,&genres=adventure&sort=user_rating,asc');        
    //     // $crawler = $client->request('GET', 'https://www.imdb.com/search/title?title_type=feature&num_votes=25000,&genres=adventure&sort=num_votes,asc');
    //     // $crawler = $client->request('GET', 'https://www.imdb.com/search/title?title_type=feature&num_votes=25000,&genres=adventure');
    //     // $crawler = $client->request('GET', 'https://www.imdb.com/search/title?title_type=feature&num_votes=25000,&genres=drama&sort=user_rating,asc');

    //     $crawler->filter('.lister-item-content')->each(function ($node) {
    //         $stopword = new StopWords();
    //         $stopword = $stopword->getStopWordsFromLanguage('en');
    //         // print $node->text()."\n";

    //         // $deskripsi = $node->filter('.lister-item-content > p.text-muted')->text()."\n";

    //         // Nama Film
    //         $nama_film = $node->filter('.lister-item-header > a')->text()."\n";
    //         $nama_film = strtolower($nama_film);
    //         $nama_film = trim(preg_replace('/([^a-z0-9]+)/i', ' ', $nama_film), '');

    //         foreach ($stopword as &$stopwords) {
    //             $stopwords = '/\b' . preg_quote($stopwords, '/') . '\b/';
    //         }

    //         $nama_film = preg_replace($stopword, '', $nama_film);
    //         $nama_film = str_replace($stopword, '', $nama_film);
    //         $nama_film = Stemm::stemPhrase($nama_film, 'en');
    //         $nama_film = trim(preg_replace('/\s+/', ' ', $nama_film));
    //         // End Nama Film


    //         // Genre Film
    //         $genre = $node->filter('.text-muted > span.genre')->text()."\n";
    //         $genre = strtolower($genre);
    //         $genre = trim(preg_replace('/([^a-z0-9]+)/i', ' ', $genre), '');

    //         foreach ($stopword as &$stopwords) {
    //             $stopwords = '/\b' . preg_quote($stopwords, '/') . '\b/';
    //         }
 
    //         $genre = preg_replace($stopword, '', $genre);
    //         $genre = str_replace($stopword, '', $genre);
    //         $genre = Stemm::stemPhrase($genre, 'en');
    //         $genre = trim(preg_replace('/\s+/', ' ', $genre));
    //         // End Genre Film


    //         // Tahun
    //         $year = $node->filter('.lister-item-header > .lister-item-year.text-muted.unbold')->text()."\n"; 
    //         $year = strtolower($year);
    //         $year = trim(preg_replace('/[^\da-z]+/i', '', $year), '');

    //         foreach ($stopword as &$stopwords) {
    //             $stopwords = '/\b' . preg_quote($stopwords, '/') . '\b/';
    //         }
 
    //         $year = preg_replace($stopword, '', $year);
    //         $year = str_replace($stopword, '', $year);
    //         // Tahun

    //         // Rating
    //         $rating = $node->filter('.ratings-bar > .ratings-imdb-rating > strong')->text()."\n";            
    //         // End Nama Film

    //         // Aktor
    //         $director = $node->filter('.lister-item-content > p > a')->text()."\n";
    //         // End Aktor

    //         if($rating >= 5) {
    //             DB::insert("INSERT INTO film_craws(id, nama_film, genre_film, rating, aktor_aktris, tahun, kelas) values (null, '$nama_film', '$genre', '$rating', '$director', '$year', 'y')");
    //         } else {
    //             DB::insert("INSERT INTO film_craws(id, nama_film, genre_film, rating, aktor_aktris, tahun, kelas) values (null, '$nama_film', '$genre', '$rating', '$director', '$year', 't')");
    //         }
    //     });
    // }

    // public function crossValidation() {
    //     $dataset = new ArrayDataset(
    //         $samples = [[1], [2], [3], [4], [5], [6], [7], [8]],
    //         $targets = ['a', 'a', 'a', 'a', 'b', 'b', 'b', 'b']
    //     );
        
    //     // $split = new StratifiedRandomSplit($dataset, 0.3, 1234);

    //     // dd($split);

    //     // $actualLabels = ['a', 'b', 'a', 'b'];
    //     // $predictedLabels = ['a', 'a', 'a', 'b'];

    //     // $acc = Accuracy::score($actualLabels, $predictedLabels);
    //     // dd($acc);

    //     $dataset = new IrisDataset();
    //     $selector = new SelectKBest();
    //     $selector->fit($samples = $dataset->getSamples(), $dataset->getTargets());
    //     dd($selector->scores());
    // }
}
