@extends('layouts.backend.app')

@section('title', 'Categorie')

@section('content')
<div class="container-fluid">

    <!-- Vertical Layout | With Floating Label -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="name" id="name" value="{{ $category->name }}" class="form-control">
                                <label class="form-label">Nom de la categorie</label>
                            </div>
                        </div>

                        <div class="form-line">
                            <input type="file" name="image" class="form-control">
                        </div>

                        <br>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-danger m-t-15 waves-effect">Retour</a>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Sauvegarder</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
