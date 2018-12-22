@extends('layouts.backend.app')

@section('title', 'Commentaires')
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
                        <span class="badge bg-info">{{ $comments->count() }}</span>
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
                                    <th class="text-center">Info Commentaire</th>
                                    <th class="text-center">Info du post</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="text-center">Info Commentaire</th>
                                    <th class="text-center">Info du post</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tbody>
                                    @foreach($comments as $key=>$comment)
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="{{ route('post.details', $comment->post->slug) }}" title="">
                                                        <img class="media-object"
                                                        src="/storage/profile/{{ $comment->user->image }}" alt="" width="64" height="64">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading">{{ $comment->user->name }} <small>{{ $comment->created_at->diffForHumans() }}</small></h4>
                                                <p>{{ $comment->comment }}</p>
                                                <a target="_blank" href="{{ route('post.details', $comment->post->slug.'#comments') }}" title="">Répondre</a>
                                            </div>

                                        </td>


                                    <td>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#" title="">
                                                    <img class="media-object"
                                                         src="/storage/profile/{{ $comment->user->image }}" alt="" width="64" height="64">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">{{ str_limit($comment->post->title, '40') }}</h4>
                                            <p><strong>Par Mr {{ $comment->post->user->name }}</strong></p>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <button type="button" onclick="deleteComment({{ $comment->id }})" class="btn btn-danger waves-effect">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        <form id="delete-form-{{ $comment->id }}" action="{{ route('admin.comment.destroy', $comment->id) }}"
                                              style="display: none" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Etes vous sûr de vouloir supprimer ?')" type="submit" class="btn btn-danger waves-effect"> <i class="material-icons">delete</i>

                                            </button>
                                        </form>
                                    </td>
                                    </tr>
                                    @endforeach
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

