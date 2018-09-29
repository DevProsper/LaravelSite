@extends('layouts.backend.app')

@section('title', 'Categories')

@section('content')
<div class="container-fluid">
    <a href="{{ route('admin.post.index') }}" class="btn btn-danger waves-effect" title="">Retour</a>
    @if($post->is_approved == false)
    <form method="POST" action="{{ route('admin.post.approve', $post->id) }}" id="approval-form">
        @csrf
        @method('PUT')
        <button type="submit" class="btn btn-access pull-right">
            <i class="material-icons">done</i>
            <span>Non Approuve</span>
        </button>
    </form>
    @else
    <button type="button" class="btn btn-access pull-right" disabled>
        <i class="material-icons">done</i>
        <span>Approuve</span>
    </button>
    @endif
    <br><br>
    <!-- Vertical Layout | With Floating Label -->
    <div class="row clearfix">
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{ $post->title }}
                        <small>
                            Poste par
                            <strong><a href="#" title="">{{ $post->user->name }}</a></strong>
                            a
                        </small>
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
                    {!! $post->body !!}
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-cyan">
                    <h2>
                        Categories
                    </h2>
                </div>
                <div class="body">
                    @foreach($post->categories as $postCategory)
                    <span class="label bg-cyan">
                        {{ $postCategory->name }}
                    </span>
                    @endforeach
                </div>
            </div>

            <div class="card">
                <div class="header bg-green">
                    <h2>
                        Tags
                    </h2>
                </div>
                <div class="body">
                    @foreach($post->tags as $postTags)
                    <span class="label bg-green">
                        {{ $postTags->name }}
                    </span>
                    @endforeach
                </div>
            </div>

            <div class="card">
                <div class="header bg-amber">
                    <h2>
                        Image du post
                    </h2>
                </div>
                <div class="body">
                    <img class="img-responsive thumbnail" src="/storage/posts/{{ $post->image }}" alt="">
                    <!-- Storage::disk('public')->url('posts/'.$post->image) -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
