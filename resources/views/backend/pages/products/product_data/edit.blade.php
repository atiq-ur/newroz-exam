@extends('backend.layouts.master')

@section('title')
   Edit-Product Data
@endsection

@section('admin-page-content')
    <div class="main-content-inner">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="header-title float-left">
                                    Edit- Product- {{ $product['data']['name'] }} - {{ $taste['data']['taste'] }}</h4>
                                @include('backend.partials.message')
                            </div>
                        </div>
                        <form id="block_id" class="form-main" action="{{ route('products.tastes.utilities.update',
                            [$taste['data']['product_id'],$taste['data']['id'], $product_data['data']['id']]) }}"
                              method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-8 col-sm-12">
                                    <label for=weights" class="col-form-label">Weights</label>
                                    <input type="text" name="weights" value="{{ $product_data['data']['weights'] }}" placeholder="weights" class="form-control" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8 col-sm-12">
                                    <label for=price" class="col-form-label">Price</label>
                                    <input type="text" name="price" value="{{ $product_data['data']['price'] }}" placeholder="price" class="form-control" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8 col-sm-12">
                                    <label for=quantity" class="col-form-label">Quantity</label>
                                    <input type="text" name="quantity" value="{{ $product_data['data']['quantity'] }}" placeholder="quantity" class="form-control" />
                                </div>
                            </div>
                            {{--<div class="form-group">
                                <label for="example-text-input" class="col-form-label">Taste Name</label>
                                <input class="form-control" name="taste" type="text" value="{{ $taste['data']['taste']}}" id="example-text-input" required>
                            </div>--}}
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

