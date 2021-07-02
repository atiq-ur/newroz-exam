@extends('backend.layouts.master')

@section('title')
    Ordered View - Newroz
@endsection

@section('admin-page-content')
    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-area">
                            <div class="invoice-head">
                                <div class="row">
                                    <div class="iv-left col-6">
                                        <span>ORDER ID</span>
                                    </div>
                                    <div class="iv-right col-6 text-md-right">
                                        <span>#{{ $order->order_id }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="invoice-address">
                                        <h3>Order To</h3>
                                        <h5>{{ $order->customer_name }}</h5>
                                        <p>{{ $order->customer_delivery_address }}</p>
                                        {{--<p>San Antonio</p>
                                        <p>Somalia</p>--}}
                                    </div>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <ul class="invoice-date">
                                        <li>Order Date :{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</li>
                                        <li>Due Date : {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="invoice-table table-responsive mt-5">
                                <table class="table table-bordered table-hover text-right">
                                    <thead>
                                    <tr class="text-capitalize">
                                        <th class="text-center" style="width: 5%;">id</th>
                                        <th class="text-left" style="width: 15%; min-width: 30px;">Product Name</th>
                                        <th class="text-left" style="width: 15%; min-width: 30px;">Taste</th>
                                        <th class="text-left" style="width: 15%; min-width: 30px;">Weights</th>
                                        <th>qty</th>
                                        <th style="min-width: 60px">Unit Cost</th>
                                        <th>total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $sub_total = 0
                                    @endphp
                                    @foreach($order->orderedProducts as $product)
                                        <tr>
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td class="text-left">{{ $product->product_name }}</td>
                                            <td class="text-left">{{ $product->taste_name }}</td>
                                            <td class="text-left">{{ $product->weights }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>{{ $product->unit_price }} &#2547;</td>
                                            <td>{{ $product->unit_price * $product->quantity }} &#2547;</td>
                                            {{ $sub_total += ($product->unit_price * $product->quantity ) }}
                                        </tr>
                                    @endforeach

                                    </tbody>
                                    @php
                                        if ($order->delivery_area == "dhaka") $delivery_charge = 60;
                                        else $delivery_charge = 100;
                                    @endphp
                                    <tfoot class="mt-5">
                                    <tr class="mt-5">
                                        <td colspan="6">Delivery Charge :</td>
                                        <td>{{ $delivery_charge  }} &#2547;</td>
                                    </tr>
                                    <tr class="mt-5">
                                        <td colspan="6">total balance :</td>
                                        <td>{{ $sub_total + $delivery_charge }} &#2547;</td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="text-left">
                            <a href="{{ route('order.getInvoice', $order->id) }}" class="btn btn-success">print invoice</a>
                        </div>
                        <div class="text-right">
                            @if($order->order_status == 0)
                                <a href="#confirmModal" class="btn btn-primary" data-toggle="modal" data-target="#confirmModal">Confirm</a>
                                <a href="#cancelModal" class="btn btn-danger" data-toggle="modal" data-target="#cancelModal">Cancel</a>
                            @elseif($order->order_status == 1)
                                <button class="btn btn-primary" disabled>Confirmed</button>
                                <a href="#cancelModal" class="btn btn-danger" data-toggle="modal" data-target="#cancelModal">Cancel</a>
                            @endif

                            @if($order->order_status == 2)
                                <a href="#confirmModal" class="btn btn-primary" data-toggle="modal" data-target="#confirmModal">Confirm</a>
                                <button class="btn btn-danger" disabled>Cancelled</button>
                            @endif
                            @if($order->order_status == 4)
                                <button class="btn btn-primary" disabled>Confirmed</button>
                                <button class="btn btn-primary" disabled>Delivered</button>
                            @elseif($order->order_status !=4)
                                <a href="#isDeliveredModal" class="btn btn-primary" data-toggle="modal" data-target="#isDeliveredModal">isDeliver</a>
                            @endif
                        </div>

                        <!-- Cancel Modal -->
                        <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Order cancel Confirmation !!</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure to Cancel this order ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="{{ route('order.cancel', $order->id) }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <button class="btn btn-danger">Cancel</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Confirm Modal -->
                        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Order Confirmation !!</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure to Confirm this order ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="{{ route('order.confirm', $order->id) }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <button class="btn btn-danger">Confirm</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Delivered Modal -->
                        <div class="modal fade" id="isDeliveredModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Order Delivery Confirmation !!</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure, this order is delivered ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="{{ route('order.isDelivered', $order->id) }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <button class="btn btn-danger">Delivered</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

