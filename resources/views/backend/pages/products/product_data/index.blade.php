@extends('backend.layouts.master')

@section('title')
    Product Data - Newroz
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
                            <h5 class="modal-title">New Taste</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form id="block_id" class="form-main" action="{{ route('products.tastes.utilities.store', [$product['data']['id'], $taste['data']['id']]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-8 col-sm-12">
                                        <label for=weights" class="col-form-label">Weights</label>
                                        <input type="text" name="weights" placeholder="weights" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8 col-sm-12">
                                        <label for=price" class="col-form-label">Price</label>
                                        <input type="text" name="price" placeholder="price" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8 col-sm-12">
                                        <label for=quantity" class="col-form-label">Quantity</label>
                                        <input type="text" name="quantity" placeholder="quantity" class="form-control" />
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
                        <h4 class="header-title float-left">Product - {{ $product['data']['name'] }} - Taste - {{ $taste['data']['taste'] }}</h4>
                        <p class="float-right mb-2">
                            <a class="btn btn-primary text-white" href="#bd-example-modal-lg" data-toggle="modal" data-target=".bd-example-modal-lg">Add New</a>
                        </p>
                        <div class="data-tables datatable-primary">
                            <table id="dataTable2" class="text-center">
                                <thead class="text-capitalize">
                                <tr>
                                    <th width="5%">Sl</th>
                                    {{--<th width="25%">Product Data</th>--}}

                                    <th width="15%">Weights</th>
                                    <th width="15%">Price</th>
                                    <th width="15%">Quantity</th>
                                    <th width="15%">Actions</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($productData['data'] as $utl)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $utl['weights'] }}</td>
                                        <td>{{ $utl['price'] }}</td>
                                        <td>{{ $utl['quantity'] }}</td>
                                        <td>
                                            <a class="btn btn-success text-white" href="{{ route('products.tastes.utilities.edit',
                                                [$product['data']['id'], $taste['data']['id'], $utl['id']]) }}">Edit</a>
                                            <a href="#deleteModal-{{ $utl['id'] }}" class="btn btn-danger" data-toggle="modal"
                                               data-target="#deleteModal-{{ $utl['id'] }}">Delete</a>
                                        </td>

                                    </tr>
                                    <div class="modal fade" id="deleteModal-{{ $utl['id']  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <form action="{{ route('products.tastes.utilities.destroy',
                                                        [$product['data']['id'], $taste['data']['id'], $utl['id']] ) }}" method="POST">
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

