<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AutoComplete extends Controller
{
    //for create controller - php artisan make:controller AutocompleteController

    function index()
    {
        return view('front.auth.autocompletesearch');
    }

    function fetch(Request $request)
    {
        if($request->get('query'))
        {  
            $query = $request->get('query');
            $data = DB::table('genres')
                ->where('nama_genre', 'LIKE', "%{$query}%")
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative; width: 100%;">';
            foreach($data as $row)
            {
                $output .= '<li class="dropdown-item dropw" style="cursor: pointer;"><a>'.$row->nama_genre.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}