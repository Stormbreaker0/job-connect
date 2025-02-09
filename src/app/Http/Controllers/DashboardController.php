<?php

namespace App\Http\Controllers;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('dashboard');
    }

    public function verify()
    {
        return view('user.verify');
    }

    public function resend(Request $request)
    {
        if(Auth::user()->hasVerifiedEmail()) {
            return redirect()->route('home')->with('success','Your email was verified');
        }

        Auth::user()->sendEmailVerificationNotification();

        return back()->with('success','Verfication link sent successfully');

    }
}
 