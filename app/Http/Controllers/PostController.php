<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

    public function index(){

        $posts = Post::latest()->approved()->published()->paginate(3);

        return view('posts', compact('posts'));
    }

    public function details($slug){

        $post = Post::where('slug', $slug)->approved()->published()->first();
        $postrandoms = Post::approved()->published()->take(3)->inRandomOrder()->get();

        $blog_key = 'blog_'. $post->id;

        if(!Session::has($blog_key)){
            $post->increment('view_count');
            Session::put($blog_key, 1);
        }

        return view('post', compact('postrandoms', 'post'));
    }

    public function postByCategory($slug){

        $categories = Category::where('slug', $slug)->first();
        $posts = $categories->posts()->approved()->published()->get();

        return view('categories', compact('categories','posts'));
    }
}
