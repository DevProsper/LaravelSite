@extends('layouts.backend.app')

@section('title', 'Post')
@section('css')
<!-- JQuery DataTable Css -->
<link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        LISTE DES FAVORIS
                        <span class="badge bg-info">{{ $posts->count() }}</span>
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
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Titre</th>
                                    <th>Autheur</th>
                                    <th><i class="material-icons">favorite</i></th>
                                    <th><i class="material-icons">visibility</i></th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Titre</th>
                                    <th>Autheur</th>
                                    <th><i class="material-icons">favorite</i></th>
                                    <th><i class="material-icons">visibility</i></th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tbody>
                                    @foreach($posts as $key=>$post)
                                    <tr>
                                        <td>{{ $key +1 * 40 }}</td>
                                        <td>{{ str_limit($post->title, '5')  }}</td>
                                        <td>{{ $post->user->name  }}</td>
                                        <td>{{ $post->favorite_to_user->count()  }}</td>
                                        <td>{{ $post->view_count  }}</td>
                                        <td class="text-center">
                                            <button type="button" onclick="removePost({{ $post->id }})" class="btn btn-info waves-effect">
                                                <i class="material-icons">visibility</i>
                                            </button>
                                            <form id="remove-form-{{ $post->id }}" action="" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button onclick="return confirm('Etes vous s�r de vouloir supprimer ?')" type="submit" class="btn btn-danger waves-effect"> <i class="material-icons">delete</i>

                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->
</div>
@endsection

@section('js')
<!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>


<link href="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js" rel="stylesheet" />
@endsection

