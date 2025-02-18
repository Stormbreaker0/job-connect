<?php

namespace App\Http\Controllers;

use App\Http\Middleware\isEmployer;
use App\Http\Middleware\isPremiumUser;
use App\Http\Requests\EditJobFormRequest;
use App\Http\Requests\PostJobFormRequest;
use App\Models\Listing;
use App\Post\JobPost;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;


class PostJobController extends Controller
{
    protected $job;
    public function __construct(JobPost $job)
    {
        $this->job = $job;
        $this->middleware('auth');
        $this->middleware(isPremiumUser::class)->only(['create', 'store']);
        $this->middleware(isEmployer::class);
    }

    public function index()
    {
        $jobs = Listing::where('user_id', Auth::user()->id)->get();

        return view('job.index', compact('jobs'));
    }
    
    public function create()
    {
        return view('job.create');
    }

    public function store(PostJobFormRequest $request)
    {
        $this->job->store($request);

        return redirect()->route('job.index')->with('success', 'Your job post has been posted');
    }


    public function edit(Listing $listing)
    {
        return view('job.edit',compact('listing'));
    }

    public function update($id, EditJobFormRequest $request)
    { 
        $this->job->updatePost($id, $request);

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }
        return back()->with('success', 'Your job post has been successfully updated');
    }


    public function destroy($id)
    {
        Listing::find($id)->delete();
        
        return back()->with('success', 'Your job post has been successfully deleted');
    }

}
