<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Http\Requests\PostJobFormRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\isPremiumUser;
use App\Http\Middleware\isEmployer;

class PostJobController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(isPremiumUser::class)->only(['create', 'store']);
        $this->middleware(isEmployer::class);
    }

    // create job post
    public function create()
    {
        return view('job.create');
    }

    // store job post
    public function store(PostJobFormRequest $request)
    {
        // format date da yyyy/mm/dd a yyyy-mm-dd
        $date = date('Y-m-d', strtotime($request->date));

        $imagePath = $request->file('feature_image')->store('images', 'public');

        $post = new Listing;
        $post->user_id = Auth::user()->id;
        $post->feature_image = $imagePath;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->roles = $request->roles;
        $post->job_type = $request->job_type;
        $post->address = $request->address;
        $post->salary = $request->salary;
        $post->application_deadline = $date;
        $post->slug = Str::slug($request->title) . '.' . Str::uuid(); // identificatore
        $post->save();

        return redirect()->route('job.index')->with('success', 'Your job post has been posted');
    }
}
