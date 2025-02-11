<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegistrationFormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\changePasswordFormRequest;


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
   public function storeSeeker(RegistrationFormRequest $request)
   {    
        $user = User::create([
            'name' =>  $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => self::JOB_SEEKER,
            'user_trial' => now()->addWeek(),
            'plan' => 'free',
            'about' => request('about')
        ]);

        Auth::login($user);

        $user->sendEmailVerificationNotification();

        return response()->json('success');

        //return redirect()->route('verification.notice')->with('message', 'Registration successful');
   }

   public function storeEmployer(RegistrationFormRequest $request)
    {
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt($request->password),
            'user_type' => self::JOB_POSTER,
            'user_trial' => now()->addWeek(),
            'plan' => 'free',
            'about' => request('about')
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
   public function postLogin(LoginFormRequest $request)
   {
        // $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required'
        // ]);

        $credentials = $request->only('email', 'password');

        try {
            if (Auth::attempt($credentials)) {
                if (!Auth::user()->email_verified_at) {
                    return redirect()->to('/verify');
                }
                if (Auth::user()->user_type == 'employer') {
                    return redirect()->to('dashboard');
                } else {
                    return redirect()->to('/');
                }
            } else {
                return back()->with('error', 'Wrong email or password');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while trying to log in. Please try again later.');
        }
    }

    //logout
    public function logout()
    {
        Auth::logout();
        
        return redirect()->to('/');
    }
 

    // User profile
    public function profile()
    {
        return view('profile.index');
    }

    // Seeker profile
    public function seekerProfile()
    {
        return view('seeker.profile');
    }

    // Change password
    public function changePassword(changePasswordFormRequest $request)
    {
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Your password has been updated successfully');

    }

    public function update(Request $request)
    {
        if($request->hasFile('profile_pic')) {
            $imagepath = $request->file('profile_pic')->store('profile', 'public');   

            User::find(Auth::user()->id)->update(['profile_pic' => $imagepath]);
        }

        User::find(Auth::user()->id)->update($request->except('profile_pic'));

        return back()->with('success','Your profile has been updated');
    }

    public function jobApplied()
    {
        $users =  User::with('listings')->where('id',Auth::user()->id)->get();

        return view('seeker.job-applied',compact('users'));
    }


    public function uploadResume(Request $request)
    {
        $request->validate([
            'resume' => 'required|mimes:pdf,doc,docx',
        ]);        

        if($request->hasFile('resume')) {
            $resume = $request->file('resume')->store('resume', 'public');   
            User::find(Auth::user()->id)->update(['resume' => $resume]);

            return back()->with('success','Your resume has been updated successfully');

        }
    }

}
