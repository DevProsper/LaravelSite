<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

    public function index(){

        $posts = Post::latest()->paginate(3);

        return view('posts', compact('posts'));
    }

    public function details($slug){

        $post = Post::where('slug', $slug)->first();
        $postrandoms = Post::all()->random('3');

        $blog_key = 'blog_'. $post->id;

        if(!Session::has($blog_key)){
            $post->increment('view_count');
            Session::put($blog_key, 1);
        }

        return view('post', compact('postrandoms', 'post'));
    }
}
