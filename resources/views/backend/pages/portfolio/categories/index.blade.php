@extends('backend.layouts.master')

@section('title')
    Category - Portfolio - Atiqur Rahman
@endsection

@section('admin-page-content')
    <div class="main-content-inner">
        <div class="row">
            <!-- data table start -->
            <div class="ml-5 modal fade bd-example-modal-lg">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Portfolio Category</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form id="block_id" class="form-main" action="{{ route('admin.category.store') }}" method="POST">
                                @csrf

                                <div class="form-row " id="dynamic_field">

                                    <div class="form-group col-md-8 col-sm-12">
                                        <label for="name">Name</label>
                                        <input type="text" name="name[]" placeholder="Name" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-4 col-sm-12 mt-4">
                                        <button type="button" name="add" id="add" class="btn btn-info button-more"><i class="fa fa-plus-circle"></i></button>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Primary table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    @include('backend.partials.message')
                    <div class="card-body">
                        <h4 class="header-title float-left">Portfolio Categories - {{ $categories->count() }}</h4>
                        <p class="float-right mb-2">
                            <a class="btn btn-primary text-white" href="#bd-example-modal-lg" data-toggle="modal" data-target=".bd-example-modal-lg">Add New</a>
                        </p>
                        <div class="data-tables datatable-primary">
                            <table id="dataTable2" class="text-center">
                                <thead class="text-capitalize">
                                <tr>
                                    <th width="5%">Sl</th>
                                    <th width="10%">Category Name</th>
                                    <th width="20%">Updated date</th>
                                    <th width="20%">Added date</th>
                                    <th width="15%">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($categories as $cat)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $cat->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($cat->updated_at)->format('d M Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($cat->created_at)->format('d M Y') }}</td>
                                        <td>
                                            <a class="btn btn-success text-white" href="{{ route('admin.category.edit', $cat->id) }}">Edit</a>
                                            <a href="#deleteModal-{{ $cat->id }}" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $cat->id }}">Delete</a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="deleteModal-{{ $cat->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation !!</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure to delete ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <form action="{{ route('admin.category.destroy', $cat->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            var i=1;
            $('#add').click(function(){
                i++;
                $('#dynamic_field').append('<div class="form-group col-md-8 col-sm-12" id="row'+i+'">' +
                    '<label for="name">Name</label>'+

                    '<input type="text" name="name[]" placeholder="Name" class="form-control" />' +
                    '</div>' +
                    '</div>'+
                    '<div class="form-group col-md-4 col-sm-12 mt-4" id="row2'+i+'">'+
                    '<button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove button-more">X</button>' +
                    '</div>'
                );
            });
            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
                $('#row2'+button_id+'').remove();
            });
        });
    </script>
@endsection
