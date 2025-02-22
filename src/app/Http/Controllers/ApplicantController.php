<?php
namespace App\Http\Controllers;

use App\Mail\ShortlistMail;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApplicantController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $listings = Listing::latest()->withCount('users')->where('user_id', Auth::user()->id)->get();

        return view('applicants.index', compact('listings'));
    }

    public function show(Listing $listing)
    {
        $this->authorize('view', $listing);

        $listing = Listing::with('users')->where('slug', $listing->slug)->first();

        return view('applicants.show', compact('listing'));
    }

    public function shortlist($listingId, $userId)
    {
        $listing = Listing::find($listingId);
        $user = User::find($userId);
        if ($listing) {
            $listing->users()->updateExistingPivot($userId, ['shortlisted' => true]);
            Mail::to($user->email)->queue(new ShortlistMail($user->name, $listing->title));

            return back()->with('success', 'User is shortlisted successfully');
        }

        return back();
    }

    public function apply($listingId)
    {
        $user = Auth::user();
        $user->listings()->syncWithoutDetaching($listingId);
        return back()->with('success', 'Your application was successfully submitted');
    }
}