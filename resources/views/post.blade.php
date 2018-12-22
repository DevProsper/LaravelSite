@extends('layouts.frontend.app')
@section('title')
    {{ $post->title }}
@endsection

@section('css')
<link href="{{ asset('assets/frontend/css/single-post/responsive.css') }}" rel="stylesheet">
<link href="{{ asset('assets/frontend/css/single-post/styles.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="slider">
        <div class="display-table  center-text">
            <h1 class="title display-table-cell"><b>DETAIL DU POST</b></h1>
        </div>
    </div><!-- slider -->

    <section class="post-area section">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-md-12 no-right-padding">

                    <div class="main-post">

                        <div class="blog-post-inner">

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="#"><img src="/storage/profile/{{ $post->user->image }}" alt="Profile Image"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b>{{ $post->user->name }}</b></a>
                                    <h6 class="date">on {{ $post->created_at->diffForHumans() }}</h6>
                                </div>

                            </div><!-- post-info -->

                            <h3 class="title"><a href="#"><b> {{ $post->title }}</b></a></h3>

                            <p class="para"> {!! html_entity_decode($post->dody) !!}</p>


                            <div class="post-image"><img src="/storage/posts/{{ $post->image }}" alt="Blog Image"></div>

                            <p class="para">{!! $post->body !!}</p>

                            <ul class="tags">
                                @foreach($post->tags as $tag)
                                    <li><a href="">{{ $tag->name }}</a></li>
                                @endforeach
                            </ul>
                        </div><!-- blog-post-inner -->

                        <div class="post-icons-area">
                            <ul class="post-icons">
                                <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                <li><a href="#"><i class="ion-eye"></i>138</a></li>
                            </ul>

                            <ul class="icons">
                                <li>SHARE : </li>
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                            </ul>
                        </div>

                        <div class="post-footer post-info">

                            <div class="left-area">
                                <a class="avatar" href="#"><img src="images/avatar-1-120x120.jpg" alt="Profile Image"></a>
                            </div>

                            <div class="middle-area">
                                <a class="name" href="#"><b>Katy Liu</b></a>
                                <h6 class="date">on Sep 29, 2017 at 9:48 am</h6>
                            </div>

                        </div><!-- post-info -->


                    </div><!-- main-post -->
                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-12 no-left-padding">

                    <div class="single-post info-area">

                        <div class="sidebar-area about-area">
                            <h4 class="title"><b>A Propos de l'auteur</b></h4>
                            <p>{{ $post->user->about }}</p>
                        </div>

                        <div class="tag-area">

                            <h4 class="title"><b>CATEGORIES</b></h4>
                            <ul>
                                @foreach($post->categories as $category)
                                    <li><a href="{{ route('category.posts', $category->slug) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>

                        </div><!-- subscribe-area -->

                    </div><!-- info-area -->

                </div><!-- col-lg-4 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section><!-- post-area -->


    <section class="recomended-area section">
        <div class="container">
            <div class="row">
                @foreach($postrandoms as $postrandom)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">

                            <div class="blog-image"><img src="/storage/posts/{{ $postrandom->image }}" alt="Blog Image"></div>

                            <a class="avatar" href="#"><img src="/storage/profile/{{ $postrandom->user->image }}" alt="Profile Image"></a>

                            <div class="blog-info">

                                <h4 class="title"><a href="{{route('post.details', $postrandom->slug)}}"><b>{{ $postrandom->title }}</b></a></h4>

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

        </div><!-- container -->
    </section>

    <section class="comment-section">
        <div class="container">
            <h4><b>Commentez</b></h4>
            <div class="row">

                <div class="col-lg-8 col-md-12">


                        @guest
                        <p>
                            Pour commenter ce post, vous devez vous connecté
                            <a href="{{ route('login') }}">Se connecter</a>
                        </p>
                        @else
                        <div class="comment-form">
                            <form method="post" action=" {{ route('comment.store', $post->id) }}">
                                <div class="row">
                                    @csrf
                                    <div class="col-sm-12">
									<textarea name="comment" rows="2" class="text-area-messge form-control"
                                              placeholder="Ecrire un commentaire" aria-required="true" aria-invalid="false"></textarea >
                                    </div><!-- col-sm-12 -->
                                    <div class="col-sm-12">
                                        <button class="submit-btn" type="submit" id="form-submit"><b>Commenter</b></button>
                                    </div><!-- col-sm-12 -->

                                </div><!-- row -->
                            </form>
                        </div><!-- comment-form -->
                            @endguest


                    <h4><b>Commentaires({{ $post->comments()->count() }})</b></h4>

                    @if($post->comments()->count() > 0)
                            @foreach($post->comments as $comment)
                                <div class="commnets-area">

                                    <div class="comment">

                                        <div class="post-info">

                                            <div class="left-area">
                                                <a class="avatar" href="#"><img src="/storage/profile/{{ $comment->user->image }}" alt="Profile Image"></a>
                                            </div>

                                            <div class="middle-area">
                                                <a class="name" href="#"><b>{{ $comment->user->name }}</b></a>
                                                <h6 class="date">on {{ $comment->created_at->diffForHumans() }}</h6>
                                            </div>

                                            {{--<div class="right-area">
                                                <h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>
                                            </div>--}}

                                        </div><!-- post-info -->

                                        <p>{{ $comment->comment }}</p>

                                    </div>

                                </div><!-- commnets-area -->
                            @endforeach
                        @else
                            Pas de commentaire pour ce post
                        @endif




                </div><!-- col-lg-8 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section>


@endsection
