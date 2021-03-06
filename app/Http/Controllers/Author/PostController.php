<?php

namespace App\Http\Controllers\Author;

use App\Category;
use App\Notifications\NewAuthorPost;
use App\Post;
use App\Tag;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::User()->posts()->latest()->get();
        return view('author.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('author.posts.create', compact('tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'  => 'required',
            'image'  => 'required',
            'categories'  => 'required',
            'tags'  => 'required',
            'body'  => 'required',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        if($image){
            $currentDate = Carbon::now()->toDateString();

            $fullName = $request->file('image')->getClientOriginalName();

            $name = pathinfo($fullName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $image_name = $slug.'-'.$currentDate.'-'.uniqid().'.'.$extension;
            $nameStore = $slug.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/posts', $image_name);
        }else{
            $image_name = 'default.png';
        }

        $post = new Post();
        $post->title = $request->title;
        $post->user_id = Auth()->id();
        $post->slug = $slug;
        $post->image = $image_name;
        $post->body = $request->body;
        if(isset($request->status)){
            $post->status = 1;
        }else{
            $post->status = 0;
        }
        $post->is_approved = false;
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        $users = User::where('role_id', '1')->get();
        Notification::send($users, new NewAuthorPost($post));

        Toastr::success('Le post a bien �t� sauvegarder', 'success');
        return redirect()->route('author.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if($post->user_id != Auth::id()){
            Toastr::error("Vous n'�tes pas authoris� a effectuer cet action", 'error');
            return redirect()->back();
        }
        return view('author.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if($post->user_id != Auth::id()){
            Toastr::error("Vous n'�tes pas authoris� a effectuer cet action", 'error');
            return redirect()->back();
        }
        $tags = Tag::all();
        $categories = Category::all();
        return view('author.posts.edit', compact('tags', 'categories','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if($post->user_id != Auth::id()){
            Toastr::error("Vous n'�tes pas authoris� a effectuer cet action", 'error');
            return redirect()->back();
        }

        $this->validate($request, [
            'title'  => 'required',
            'image'  => 'image',
            'categories'  => 'required',
            'tags'  => 'required',
            'body'  => 'required',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        if($image){
            $currentDate = Carbon::now()->toDateString();

            if(!Storage::disk('public')->exists('posts')){
                Storage::disk('public')->makeDirectory('posts');
            }

            $fullName = $request->file('image')->getClientOriginalName();

            //Suppression du fichier
            if(Storage::disk('public')->exists('posts/'.$post->image)){
                Storage::disk('public')->delete('posts/'.$post->image);
            }

            $name = pathinfo($fullName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $image_name = $slug.'-'.$currentDate.'-'.uniqid().'.'.$extension;
            $nameStore = $slug.'_'.time().'.'.$extension;
            $path = $image->storeAs('public/posts', $image_name);

        }else{
            $image_name = $post->image;
        }

        $post->title = $request->title;
        $post->user_id = Auth()->id();
        $post->slug = $slug;
        $post->image = $image_name;
        $post->body = $request->body;
        if(isset($request->status)){
            $post->status = 1;
        }else{
            $post->status = 0;
        }
        $post->is_approved = false;
        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        Toastr::success('Le post a bien �t� sauvegarder', 'success');
        return redirect()->route('author.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->user_id != Auth::id()){
            Toastr::error("Vous n'�tes pas authoris� a effectuer cet action", 'error');
            return redirect()->back();
        }

        if(Storage::disk('public')->exists('posts/'.$post->image)){
            Storage::disk('public')->delete('posts/'.$post->image);
        }

        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();
        Toastr::success('Le post a bien �t� supprimer', 'success');
        return redirect()->back();
    }
}