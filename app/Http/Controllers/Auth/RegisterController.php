<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct(){
        $this->middleware('guest');
    }
    //In here are the methods, will be called in Routes by the class name
    public function index(){
        return view('auth.register');
    }
    public function store(Request $request){    //$request object contains all information in that request
       // dd('Hello');    // dd function: Die dump : kills the function and displays whatever's in there
       //validation
       $this->validate($request, [  //validates the inputes based on the rules given below rules can be found inthe laravel doc
        'name' => 'required|max:255',
        'username' => 'required|max:255',
        'email' => 'required|email|max:255',
        'password' => 'required|confirmed',      //checks that the password field is the same as the password_confirmation field
        ]);
        //Anything below won't be run, it will be redirected to the same page if the above validation fails

        //store user
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),   //the Hash facade used as a Facade(front for underlying functionality)?? so that the password is not sent as a plain text
        ]);

        //signin user
        //  auth()->user();     Finds the signed in user or returns null useful if wanna display username
        auth()->attempt($request->only('email', 'password'));    /*equivalent to [▼"email" => "mmm@gmail.com", "password" => "melat"]*/
        return redirect()->route('dashboard');


    }
}
