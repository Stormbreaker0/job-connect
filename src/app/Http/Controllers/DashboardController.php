<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use App\Models\Listing;



class DashboardController extends Controller
{


    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {   
        $WEEKLY_AMOUNT = 9.99;
        $MONTHLY_AMOUNT = 29.99;
        $YEARLY_AMOUNT = 149.99;
        $FREE_AMOUNT = 0.00;

        $user = Auth::user();
        
        $totalJobsPosted = Listing::where('user_id', $user->id)->count();
        $totalApplicants = Listing::where('user_id', $user->id)->withCount('users')->get()->sum('users_count');


        if($user->plan === 'weekly') {
            $plan = 'weekly';
            $amount = $WEEKLY_AMOUNT;
            return view('dashboard', compact('totalJobsPosted', 'totalApplicants', 'plan', 'amount'));     
        }
        if($user->plan === 'monthly') {
            $plan = 'Monthly';
            $amount = $MONTHLY_AMOUNT;
            return view('dashboard', compact('totalJobsPosted', 'totalApplicants', 'plan', 'amount'));     
        }
        if($user->plan === 'yearly') {
            $plan = 'Yearly';
            $amount = $YEARLY_AMOUNT;
            return view('dashboard', compact('totalJobsPosted', 'totalApplicants', 'plan', 'amount'));     
        }
        if($user->plan === 'free') {
            $plan = 'Trial';
            $amount = $FREE_AMOUNT;
            return view('dashboard', compact('totalJobsPosted', 'totalApplicants', 'plan', 'amount'));     
        }

        //return view('dashboard', compact('totalJobsPosted', 'totalApplicants', 'plan'));        
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
 