<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Phpml\Classification\KNearestNeighbors;
use Phpml\Dataset\Demo\IrisDataset;
use Phpml\FeatureSelection\SelectKBest;

class KnnController extends Controller
{
    public function index() {
        // $classifier = new KNearestNeighbors($k=4);

        $sample = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
        $labels = ['a', 'a', 'a', 'b', 'b', 'b'];

        // $classifier = new KNearestNeighbors();
        // $classifier->train($samples, $labels);

        // $irisDataset = new IrisDataset();

        $dataset = new IrisDataset();
        $selector = new SelectKBest(3);
        $selector->fit($samples = $sample, $labels);
        $selector->transform($samples);
        // $selector->scores();

        // dd($classifier->predict([3, 2]));
        dd($selector);
    }
}
