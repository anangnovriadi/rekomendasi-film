<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct() {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm() {
        return view('admin.auth.login.login');
    }

    public function login(Request $request) {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request->username;
        $password = $request->password;

        if(Auth::guard('admin')->attempt(['username' => $username, 'password' => $password])) {
            // return redirect()->intended(route('admin.dashboard'));
            return redirect()->route('dashboard');
        }

        return redirect()->back();
    }

    public function logout(Request $request) {
        Auth::guard('admin')->logout();
        
        return redirect()->guest(route('admin.login'));
    }
}
