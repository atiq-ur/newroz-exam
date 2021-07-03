@extends('backend.layouts.master')

@section('title')
    Occasion Offer - Newroz
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
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="header-title float-left">Edit Product Name </h4>
                                    @include('backend.partials.message')
                                </div>
                            </div>
                            <form id="edit-form" class="form-main" action="{{ route('preOrder.offers.update', $offer['data']['id']) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="form-group col-md-8 col-sm-12">
                                        <label for=name" class="col-form-label">Offer Name</label>
                                        <input type="text" name="name" value="{{ $offer['data']['name'] }}" placeholder="name" class="form-control"  required/>
                                    </div>
                                </div>
                                @php
                                    $strt_date = \Carbon\Carbon::parse($offer['data']['start_time'])->format('Y-m-d');
                                    $strt_time = \Carbon\Carbon::parse($offer['data']['start_time'])->format('H:i:s');
                                    $end_date = \Carbon\Carbon::parse($offer['data']['end_time'])->format('Y-m-d');
                                    $end_time = \Carbon\Carbon::parse($offer['data']['end_time'])->format('H:i:s');
                                @endphp

                                <div class="form-row">
                                    <div class="form-group col-md-8 col-sm-12">
                                        <label for=minimum_order_quantity" class="col-form-label">Minimum Order Of Quantity</label>
                                        <input type="number" name="minimum_order_quantity" value="{{ $offer['data']['minimum_order_quantity'] }}" placeholder="minimum_order_quantity" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8 col-sm-12">
                                        <label for=fixed_amount" class="col-form-label">Fixed Amount (If choose Percentage then ignore this input)</label>
                                        <input type="number" name="fixed_amount" value="{{ $offer['data']['fixed_amount'] }}" placeholder="fixed_amount" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8 col-sm-12">
                                        <label for=percentage" class="col-form-label">Offer Percentage (If choose Percentage then ignore this input)</label>
                                        <p class="text-sm-left"> ** N.B. Do not include Percentage Sign here</p>
                                        <input type="number" name="percentage" value="{{ $offer['data']['percentage'] }}" placeholder="percentage" class="form-control"/>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="example-datetime-local-input" class="col-form-label">Start Time</label>
                                        <input class="form-control" name="start_time" value="{{ $strt_date.'T'.$strt_time }}" type="datetime-local"  id="example-datetime-local-input" step="any">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="example-datetime-local-input" class="col-form-label">End Time</label>
                                        <input class="form-control" name="end_time" type="datetime-local" value="{{ $end_date.'T'.$end_time }}" id="example-datetime-local-input" step="any">
                                    </div>
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
@section('scripts')

@endsection
