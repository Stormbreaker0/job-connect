<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeekerLoginRequest;
use App\Http\Requests\SeekerRegistrationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;


class UserController extends Controller
{   
    const JOB_SEEKER = 'seeker';
    const JOB_POSTER = 'employer';

    // create seeker
    public function createSeeker()
    {
        return view('user.seeker-register');
    }

    // create employer
    public function createEmployer()
    {
        return view('user.employer-register');
    }

    // store seeker data from request to database
   public function storeSeeker(SeekerRegistrationRequest $request)
   {    
        $user = User::create([
            'name' =>  $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => self::JOB_SEEKER,
            'user_trial' => now()->addWeek()
        ]);

        Auth::login($user);

        $user->sendEmailVerificationNotification();

        return response()->json('success');

        //return redirect()->route('verification.notice')->with('message', 'Registration successful');
   }

   public function storeEmployer(SeekerRegistrationRequest $request)
    {
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'user_type' => self::JOB_POSTER,
            'user_trial' => now()->addWeek()
        ]);

        Auth::login($user);

        $user->sendEmailVerificationNotification();

        return response()->json('success');

        // return redirect()->route('verification.notice')->with('successMessage','Your account was created');
    }

   public function login()
   {
        return view('user.login');
   }

   // process login
   public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentails = $request->only('email', 'password');

        if(Auth::attempt($credentails)) {
            if(!Auth::user()->email_verified_at)
            {
                return redirect()->to('/verify');
            }
            if(Auth::user()->user_type == 'employer') {
                return redirect()->to('dashboard');
            }else {
                return redirect()->to('/');
            }
        }

        return 'Wrong email or password';
    }

    //logout
    public function logout()
    {
        Auth::logout();
        return redirect()->to('/');

       // return redirect()->route('login');
    }

}
