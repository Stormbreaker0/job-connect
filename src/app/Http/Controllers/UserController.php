<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeekerLoginRequest;
use App\Http\Requests\SeekerRegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;

use function Laravel\Prompts\password;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{   
    const JOB_SEEKER = 'seeker';

    // create seeker
    public function createSeeker()
    {
        return view('user.seeker-register');
    }

    // store data from request to database
   public function storeSeeker(SeekerRegistrationRequest $request)
   {    
        User::create([
            'name' =>  $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => self::JOB_SEEKER,
        ]);

        return back();
   }

   public function login()
   {
        return view('user.login');
   }

   // process login
   public function postLogin(SeekerLoginRequest $request)
   {
        $credentials = $request->only('email', 'password');    
        if(Auth::attempt($credentials)){
            return redirect() -> intended('dashboard');
        }
   }
}
