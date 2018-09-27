<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Post;
use App\Tag;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $posts = Post::latest()->paginate(110);
        return view('admin.posts.index', compact('posts'));
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
        return view('admin.posts.create', compact('tags', 'categories'));
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
        $post->is_approved = true;
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        Toastr::success('Le post a bien �t� sauvegarder', 'success');
        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.posts.edit', compact('tags', 'categories','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
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
        $post->is_approved = true;
        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        Toastr::success('Le post a bien �t� sauvegarder', 'success');
        return redirect()->route('admin.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
