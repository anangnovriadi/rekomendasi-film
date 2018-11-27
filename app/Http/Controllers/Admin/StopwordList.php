<?php

namespace App\Http\Controllers\Admin;

class Stopword {
    public function stopwordList() {
        $all = array(
            'a', 'about', 'above', 'after', 'again', 'against', 'all',
            'am', 'an', 'and', 'any', 'are', 'arent', 'as', 'at', 'be',
            'as', 'because', 'been', 'before', 'being', 'below', 'between',
            'both', 'but', 'by', 'cant', 'cannot', 'could', 'did', 'do', 'does',
            'down', 'during', 'each', 'few', 'for', 'from', 'had', 'has', 'have'
        );

        return $all;
    }
}