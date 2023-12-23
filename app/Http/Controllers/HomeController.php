<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $featuredPosts = Cache::remember('featuredPostsItems', Carbon::now()->addHours(1), function () {
            return Post::published()
                ->featured()
                ->with('categories')
                ->latest('published_at')
                ->take(3)
                ->get();
        });

        $latestPosts = Cache::remember('latestPostsItems', 3600, function () {
            return Post::published()
                ->with('categories')
                ->latest('published_at')
                ->take(9)
                ->get();
        });

        return view('home', [
            'featuredPosts' => $featuredPosts,
            'latestPosts' => $latestPosts,
        ]);
    }
}
