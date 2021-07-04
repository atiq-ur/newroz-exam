@extends('backend.layouts.master')

@section('title')
    Pre Order Products - Newroz
@endsection

@section('admin-page-content')

    <div class="main-content-inner">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-title">
                        <h3 class="text-sm-center">Your can Pre Order Products With amazing Offers</h3>
                        <p class="text-sm-center">**You can order even stock out Products.
                            We will notify when products wil be in stock. </p>
                    </div>
                    <hr>
                    <div class="card-title">
                        <h3 class="text-sm-center">Current Offer -{{ $currentOffer['data']['name'] }}</h3>
                        <p class="text-sm-center">**You can get
                            {{ $currentOffer['data']['fixed_amount'] == null ? $currentOffer['data']['percentage'] .'%'
                                    : $currentOffer['data']['fixed_amount'].' Taka'}} if you buy at least
                            {{ $currentOffer['data']['minimum_order_quantity'] }} products as a pre-order. **</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title float-left mb-4">Choose Products</h4>
                        <hr class="mb-5 mt-4">
                        <div class="row">
                            @foreach($preOrderProducts['data'] as $product)
                                <div class="col-sm-6 col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $product['name'] }}</h5>
                                            <p class="card-text">Some Info about Product.</p>
                                            <a href="{{ route('preOrder.orders.detail', $product['name']) }}" class="btn btn-primary">View</a>
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

