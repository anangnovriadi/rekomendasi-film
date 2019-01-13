<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Cosine;
use App\Model\Term;
use App\Model\Tf_idf;
use App\Model\Cos;
use DB;

class LogoutController extends Controller 
{
    public function logout(Request $request) {
        $request->session()->flush();
        $request->session()->regenerate();

        Tf_idf::query()->truncate();
        Term::query()->truncate();
        Cosine::query()->truncate();
        Cos::query()->truncate();
        DB::table('k_optimals')->truncate();
        DB::table('kelas_selected')->truncate();

        return redirect()->route('login');
    }
}