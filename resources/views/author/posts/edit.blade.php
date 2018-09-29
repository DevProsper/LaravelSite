@extends('layouts.backend.app')

@section('title', 'Categories')

@section('css')
<link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="container-fluid">

    <!-- Vertical Layout | With Floating Label -->
    <div class="row clearfix">
        <form action="{{ route('author.post.update',$post->id) }}" method="POST" enctype="multipart/form-data">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            EDITER LA CATEGORIE
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        @csrf
                        @method('PUT')
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" value="{{ $post->title }}" 
                                name="title" id="title" class="form-control">
                                <label class="form-label">Titre du post</label>
                            </div>
                        </div>

                        <br>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <br>
                        <div class="form-group">
                            <input type="checkbox" id="status" class="filled-in chk-col-red" name="status" value="1"
                                    {{ $post->status == true ? 'checked' : '' }}/>
                            <label for="status">Publié</label>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            CATEGORIE ET TAG
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="form-group form-float">
                            <div class="form-line {{ $errors->has('categories') ? 'focused error' : '' }}">
                                <label class="category">Selectioner la catégorie</label>
                                <select name="categories[]" id="category" class="form-control show-tick" data-live-search="true" multiple>
                                    @foreach($categories as $category)
                                    <option
                                            @foreach($post->categories as $postCategory)
                                                    {{ $postCategory->id == $category->id ? 'selected' : '' }}
                                            @endforeach
                                            value="{{ $category->id }}
                                                    ">
                                        {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('categories') ? 'focused error' : '' }}">
                                    <label class="tag">Selectioner le tag</label>
                                    <select name="tags[]" id="tag" class="form-control show-tick" data-live-search="true" multiple>
                                        @foreach($tags as $tag)
                                        <option
                                                @foreach($post->tags as $postTags)
                                                {{ $postTags->id == $tag->id ? 'selected' : '' }}
                                                @endforeach
                                                value="{{ $tag->id }}">{{
                                            $tag->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <br>
                                <a href="{{ route('author.post.index') }}" class="btn btn-danger m-t-15 waves-effect">Retour</a>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Sauvegarder</button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    NOUVELLE CATEGORIE
                                </h2>
                                <ul class="header-dropdown m-r--5">
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a href="javascript:void(0);">Action</a></li>
                                            <li><a href="javascript:void(0);">Another action</a></li>
                                            <li><a href="javascript:void(0);">Something else here</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <textarea name="body">
                                    {{ $post->body }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @endsection

        @section('js')
        <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }} "></script>

        <!-- TinyMCE -->

        <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
        <script>tinymce.init({ selector:'textarea' });</script>
        @endsection