<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\View\View;

class FavoriteController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        
        // Get all favorited chirps by the user
        $favoritedChirpIds = \App\Models\Favoritable::where('user_id', $user->id)
            ->where('favoritable_type', Chirp::class)
            ->pluck('favoritable_id');
        
        $chirps = Chirp::with('user')
            ->whereIn('id', $favoritedChirpIds)
            ->latest()
            ->paginate(10);

        return view('favorites.index', compact('chirps'));
    }
}
