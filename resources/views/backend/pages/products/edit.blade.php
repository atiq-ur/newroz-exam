@extends('backend.layouts.master')

@section('title')
   Edit-Product
@endsection

@section('admin-page-content')
    <div class="main-content-inner">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="header-title float-left">Edit Product Name </h4>
                                @include('backend.partials.message')
                            </div>
                        </div>
                        <form id="block_id" class="form-main" action="{{ route('products.update', $product['data']['id']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="example-text-input" class="col-form-label">Name</label>
                                <input class="form-control" name="name" type="text" value="{{ $product['data']['name']}}" id="example-text-input" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Primary table end -->
            <!-- data table end -->

        </div>
    </div>
@endsection

