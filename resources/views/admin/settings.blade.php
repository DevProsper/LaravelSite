@extends('layouts.backend.app')

@section('title', 'Paramètres')

@section('content')
    <div class="container-fluid">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    TABS WITH ICON TITLE
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="">
                        <a href="#profile_with_icon_title" data-toggle="tab" aria-expanded="false">
                            <i class="material-icons">face</i> MODIFIER LE PROFILE
                        </a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#settings_with_icon_title" data-toggle="tab" aria-expanded="false">
                            <i class="material-icons">face</i> MOT DE PASSE
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">
                        <form class="form-horizontal" action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="name">Nom : </label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="name" value="{{ Auth::user()->name }}" name="name" class="form-control" placeholder="Ex: NGOUARI Prosper">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="name">Votre Adresse Email : </label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="email" value="{{ Auth::user()->email }}" name="email" class="form-control" placeholder="Ex: NGOUARI Prosper">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="name">Image du Profile : </label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" name="image" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="name">A Propos de l'auteur : </label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="5" name="about" class="form-control">
                                                {{ Auth::user()->about }}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">METTRE A JOUR</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="settings_with_icon_title">
                        <form action="{{ route('admin.password.update') }}" method="POST">
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="name" name="old_password" class="form-control" placeholder="Ancien mot de passe">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="name" name="password" class="form-control" placeholder="Mot de passe de passe">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="name" name="password_confirmation" class="form-control" placeholder="Mot de passe de confirmation">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">METTRE A JOUR</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
