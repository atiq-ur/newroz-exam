@extends('backend.layouts.master')

@section('title')
    Order Product - Newroz
@endsection

@section('admin-page-content')

    <div class="main-content-inner">

        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title float-left mb-4">Choose Products</h4>
                        <p class="float-right mb-5">
                            <a class="btn btn-info text-white" href="#bd-example-modal-lg" data-toggle="modal" data-target=".bd-example-modal-lg">Cart</a>
                        </p>
                        <hr class="mb-5 mt-4">
                        <div class="row">
                            @foreach($products['data'] as $product)
                                <div class="col-sm-6 col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $product['name'] }}</h5>
                                            <p class="card-text">Some Info about Product.</p>
                                            <a href="{{ route('order.details', $product['name']) }}" class="btn btn-primary">View</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

