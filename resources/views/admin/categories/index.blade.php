@extends('layouts.backend.app')

@section('title', 'Tag')
@section('css')
<!-- JQuery DataTable Css -->
<link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <a class="btn btn-primary btn-lg waves-effect" href="{{ route('admin.categories.create') }}" title="">
            <i class="material-icons">add</i>
            <span>Nouvelle Categorie</span>
        </a>
    </div>
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        LISTE DES CATEGORIES
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
                                    <th>Nom</th>
                                    <th>Nombre de post</th>
                                    <th>Date de création</th>
                                    <th>Date de modification</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Nombre de post</th>
                                    <th>Date de création</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tbody>
                                    @foreach($categories as $key=>$category)
                                    <tr>
                                        <td>{{ $key +1 * 40 }}</td>
                                        <td>{{ $category->name  }}</td>
                                        <td>{{ $category->posts->count()  }}</td>
                                        <td>{{ $category->created_at }}</td>
                                        <td>{{ $category->updated_at }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-info waves-effect">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <form action="{{ route('admin.categories.destroy', [$category->id]) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button onclick="return confirm('Etes vous sûr de vouloir supprimer ?')" type="submit" class="btn btn-danger waves-effect"> <i class="material-icons">delete</i>

                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </tbody>
                        </table>
                        {{ $categories->links() }}
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
<script type="text/javascript">
    function deleteTag(id){
        swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                swal(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
            } else if (result.dismiss === swal.DismissReason.cancel) {
                swal('Cancelled', 'Your imaginary file is safe :)', 'error'
                    )
            }
        })
    }
</script>
@endsection

