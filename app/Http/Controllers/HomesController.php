<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function view() {
        // $id = Auth::user();
        $id = Auth::id();
        dd($id);
        return view('front.home-film');
    }

    public function getUser() {
        $user = DB::select('SELECT * from users WHERE id = ?', array(1));

        foreach($user as $users) {
            $id = $users->id;
        }

        return $id;
    }
}
