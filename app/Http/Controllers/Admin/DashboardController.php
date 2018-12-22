<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\DocBlock\Tag;

class DashboardController extends Controller
{
    public function index(){

         $posts = Post::all();

         $popular_posts = Post::withCount('comments')
            ->withCount('favorite_to_user')
            ->orderBy('view_count', 'desc')
            ->orderBy('comments_count', 'desc')
            ->orderBy('favorite_to_user_count', 'desc')
            ->take(5)->get();

         $total_pending_posts = Post::where('is_approved', false)->count();

         $all_views = Post::sum('view_count');

         $author_count = User::where('role_id', 1)->count();

         $new_authors_today = User::where('role_id', 1)
                        ->whereDate('created_at', Carbon::today())->count();

         $active_authors = User::where('role_id', 1)
                        ->withCount('posts')
                        ->withCount('comments')
                        ->withCount('favorite_posts')
                        ->orderBy('posts_count', 'desc')
                        ->orderBy('comments_count', 'desc')
                        ->orderBy('favorite_posts_count', 'desc')->get();

         $category_count = Category::all()->count();




    	return view('admin.dashboard', compact('posts', 'popular_posts', 'total_pending_posts', 'all_views',
            'author_count', 'new_authors_today', 'active_authors', 'category_count'));
    }
}
