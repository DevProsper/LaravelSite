@extends('layouts.frontend.app')
@section('title')

@endsection

@section('css')
    <link href="{{ asset('assets/frontend/css/category/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/category/styles.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="slider display-table center-text">
        <h1 class="title display-table-cell"><b>LISTING DES ARTICLES</b></h1>
    </div><!-- slider -->

    <section class="blog-area section">
        <div class="container">

            <div class="row">
                @foreach($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">

                                <div class="blog-image"><img src="/storage/posts/{{ $post->image }}" alt="Blog Image"></div>

                                <a class="avatar" href="{{route('post.details', $post->slug)}}"><img src="/storage/profile/{{ $post->user->image }}" alt="Profile Image"></a>

                                <div class="blog-info">

                                    <h4 class="title"><a href="{{route('post.details', $post->slug)}}"><b>{{ $post->title }}</b></a></h4>

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
            </div><!-- row -->

            {{ $posts->links() }}

        </div><!-- container -->
    </section><!-- section -->


@endsection
