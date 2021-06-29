@extends('backend.layouts.master')

@section('title')
    Products - Newroz
@endsection

@section('admin-page-content')
    <div class="main-content-inner">
        @if ($errors->any())
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="modal fade bd-example-modal-lg ml-5">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">New Product</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form id="block_id" class="form-main" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-8 col-sm-12">
                                        <label for=name" class="col-form-label">Product Name</label>
                                        <input type="text" name="name" placeholder="name" class="form-control" />
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
                    <div class="card-body">
                        <h4 class="header-title float-left">Products</h4>
                        <p class="float-right mb-2">
                            <a class="btn btn-primary text-white" href="#bd-example-modal-lg" data-toggle="modal" data-target=".bd-example-modal-lg">Add New</a>
                        </p>
                        <div class="data-tables datatable-primary">
                            <table id="dataTable2" class="text-center">
                                <thead class="text-capitalize">
                                <tr>
                                    <th width="5%">Sl</th>
                                    <th width="25%">Product Name</th>
                                    <th width="25%">Taste</th>
                                    <th width="25%">Actions</th>
                                    <th width="15%"></th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($products['data'] as $product)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $product['name'] }}</td>
                                        <td>
                                            <a class="btn btn-primary text-white" href="{{ route('products.tastes.index', $product['id']) }}">Tastes</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-success text-white" href="{{ route('products.edit', $product['id']) }}">Edit</a>
                                            <a href="#deleteModal-{{ $product['id'] }}" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $product['id'] }}">Delete</a>
                                        </td>

                                    </tr>
                                    <div class="modal fade" id="deleteModal-{{ $product['id']  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <form action="{{ route('products.destroy', $product['id'] ) }}" method="POST">
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
            <!-- Primary table end -->
            <!-- data table end -->

        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            var i=1;
            $('#add').click(function(){

                i++;
                $('#dynamic_field').append('' +
                    '<div class="col-md-10" id="row'+i+'">' +
                    '<label for=image" class="col-form-label">Project Image '+i+'</label>'+

                    '<input id="image" type="file" name="images[]" class="form-control" />' +
                    '</div>' +
                    '</div>'+
                    '<div class="col-md-2" style="margin-top: 38px;" id="row2'+i+'">'+
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
