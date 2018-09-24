<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->paginate(1);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.categories.create');
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
            'name'   => 'required|unique:categories',
            'image'  => 'required|mimes:jpeg,jpg,bmp,png'
        ]);

        $slug = str_slug($request->name);
        if($request->hasFile('image')){

            $currentDate = Carbon::now()->toDateString();




            $fullName = $request->file('image')->getClientOriginalName();
            $name = pathinfo($fullName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $image_name = $slug.'-'.$currentDate.'-'.uniqid().'.'.$extension;
            $nameStore = $slug.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/category', $image_name);
            $path2 = $request->file('image')->storeAs('public/category/slider', $image_name);
        }
        /*$image = $request->file('image');
        $slug = str_slug($request->name);

        if(isset($image)){
            $fullName = $image->getClientOriginalName();


            if(!Storage::disk('public')->exists('category')){
                Storage::disk('public')->makeDirectory('category');
            }

            $category = Image::make('public/category/'.$image)->resize(1600,479)->save();
            Storage::disk('public')->put('category/'.$image_name,$category);

            if(!Storage::disk('public')->exists('category/slider')){
                Storage::disk('public')->makeDirectory('category/slider');
            }

            $slider = Image::make('public/slider/'.$image)->resize(500,333)->save();
            Storage::disk('public')->put('category/slider/'.$image_name,$slider);
        }*/
        else{
            $image_name = 'default.png';
        }

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $image_name;
        $category->save();

        Toastr::success('La categorie a bien été sauvegarder', 'success');
        return redirect()->route('admin.categories.index');
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
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'   => 'required',
            //'image'  => 'required|mimes:jpeg,jpg,bmp,png'
        ]);
        $category = Category::find($id);
        $slug = str_slug($request->name);
        $image = $request->file('image');
        if(isset($image)){

            $currentDate = Carbon::now()->toDateString();

            if(Storage::disk('public')->exists('category/'.$category->image)){
                Storage::disk('public')->delete('category/'.$category->image);
            }

            if(Storage::disk('public')->exists('category/slider/'.$category->image)){
                Storage::disk('public')->delete('category/slider/'.$category->image);
            }

            $fullName = $request->file('image')->getClientOriginalName();
            $name = pathinfo($fullName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $image_name = $slug.'-'.$currentDate.'-'.uniqid().'.'.$extension;


            $path = $image->storeAs('public/category', $image_name);
            $path2 = $image->storeAs('public/category/slider', $image_name);
        } else{
            $image_name = $category->image;
        }

        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $image_name;
        $category->save();
        Toastr::success('La categorie a bien été modifié :)', 'Success');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if(Storage::disk('public')->exists('category/'.$category->image)){
            Storage::disk('public')->delete('category/'.$category->image);
        }

        if(Storage::disk('public')->exists('category/slider/'.$category->image)){
            Storage::disk('public')->delete('category/slider/'.$category->image);
        }

        $category->delete();

        Toastr::success('La categorie a bien été supprimer', 'success');
        return redirect()->back();
    }
}
