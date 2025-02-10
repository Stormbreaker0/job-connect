<?php
namespace App\Policies;

use App\Models\Listing;
use App\Models\User;

class ListingPolicy
{
    public function view(User $user, Listing $listing)
    {
        // Definisci la logica di autorizzazione
        return $user->id === $listing->user_id;
    }
}