@extends('layouts.frontend.app')
@section('title')
{{ $query }}
@endsection

@section('css')
<link href="{{ asset('assets/frontend/css/category/responsive.css') }}" rel="stylesheet">
<link href="{{ asset('assets/frontend/css/category/styles.css') }}" rel="stylesheet">

@endsection

@section('content')

<div class="slider display-table center-text">
    <h1 class="title display-table-cell"><b>{{ $posts->count() }} Resultat(s) pour {{ $query }}</b></h1>
</div><!-- slider -->

<section class="blog-area section">
    <div class="container">

        <div class="row">
            @if($posts->count() > 0 )
            @foreach($posts as $category)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="single-post post-style-1">

                        <div class="blog-image"><img src="/storage/posts/{{ $category->image }}" alt="Blog Image"></div>

                        <a class="avatar" href="{{route('post.details', $category->slug)}}">
                            <img src="/storage/profile/{{ $category->user->image }}" alt="Profile Image"></a>

                            <div class="blog-info">

                                <h4 class="title"><a href="{{route('post.details', $category->slug)}}"><b>{{ $category->title }}</b></a></h4>

                                <ul class="post-footer">
                                    <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                    <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>138</a></li>
                                </ul>

                            </div><!-- blog-info -->
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div>
                @endforeach
                @else
                Aucun post pour cette categorie
                @endif
            </div><!-- row -->

        </div><!-- container -->
    </section><!-- section -->


    @endsection
