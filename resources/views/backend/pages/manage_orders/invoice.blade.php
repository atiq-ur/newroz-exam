@extends('backend.layouts.master')

@section('title')
    Invoice #{{ $order->order_id }} - Newroz
@endsection

@section('admin-page-content')
    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12">
                <embed src="{{ asset('backend/orders/invoices/'.$order->order_id.'.pdf') }}#toolbar=1" type="application/pdf" width="100%" height="640px" />
            </div>
        </div>
    </div>
@endsection

