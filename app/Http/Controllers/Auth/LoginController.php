<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest');
    }
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){
        $this->validate($request, [  //validates the inputes based on the rules given below rules can be found inthe laravel doc
            'email' => 'required|email',
            'password' => 'required',      //checks that the password field is the same as the password_confirmation field
            ]);
        //signin user
        //  auth()->user();     Finds the signed in user or returns null useful if wanna display username
        if(!auth()->attempt($request->only('email', 'password'), $request->remember)){
            return back()->with('status', 'Invalid login details');
        }
        return redirect()->route('dashboard');
    }
}
