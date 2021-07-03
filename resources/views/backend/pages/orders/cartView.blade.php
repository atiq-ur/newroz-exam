@extends('backend.layouts.master')

@section('title')
   Product Details
@endsection
@section('styles')
@include('backend.partials.shopping_cart')
@endsection
@section('admin-page-content')
    <div class="main-content-inner">
        <div class="card">
            <div class="container px-4 py-5 mx-auto">
                <div class="row d-flex justify-content-center">
                    <div class="col-5">
                        <h4 class="heading">Shopping Bag</h4>
                    </div>
                    <div class="col-7">
                        <div class="row text-right">
                            <div class="col-4">
                                <h6 class="mt-2">Weights</h6>
                            </div>
                            <div class="col-4">
                                <h6 class="mt-2">Quantity</h6>
                            </div>
                            <div class="col-4">
                                <h6 class="mt-2">Price</h6>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $totalAmount = 0;
                @endphp
                @foreach($carts as $cart)
                    <div class="row d-flex justify-content-center border-top">
                    <div class="col-5">
                        <div class="row d-flex">
                            <div class="my-auto flex-column d-flex pad-left">
                                <h6 class="mob-text">{{ $cart->product_name }}</h6>
                                <p class="mob-text">Taste - {{ $cart->taste }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="my-auto col-7">
                        <div class="row text-right">
                            <div class="col-4">
                                <p class="mob-text">{{ $cart->weights }}</p>
                            </div>
                            <div class="col-4">
                                <div class="row d-flex justify-content-end px-3">
                                    <p class="mb-0" id="cnt1">{{ $cart->quantity }}</p>
                                    <div class="d-flex flex-column plus-minus"> <span class="vsm-text plus">+</span> <span class="vsm-text minus">-</span> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <h6 class="mob-text">{{ $cart->quantity * $cart->price }} Taka</h6>
                                @php
                                    $totalAmount += ($cart->quantity * $cart->price);
                                @endphp
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <hr>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <form action="{{ route('order.place.confirm') }}" method="POST">
                            @csrf
                            @if(\App\Models\Cart::isPreOrder())
                                <input type="hidden" name="isPreOrder" value="1"/>
                            @else
                                <input type="hidden" name="isPreOrder" value="0"/>
                            @endif
                            <li>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-10 col-sm-12">
                                            <label class="col-form-label">Where to delivery ? </label>
                                            <select class="form-select" aria-label="Default select example" name="delivery_area" id="shipping" required>
                                                <option selected>Choose delivery Area</option>
                                                <option value="dhaka">Dhaka</option>
                                                <option value="outside">Outside Dhaka</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter full name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" name="email" class="form-control" id="email" placeholder="Enter email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="mobile_number" class="form-label">Mobile Number</label>
                                        <input type="text" name="mobile_number" class="form-control" id="mobile_number" placeholder="0123456789" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Delivery Address</label>
                                        <input type="text" name="address" class="form-control" id="address" placeholder="56/A, Dhanmondi,Dhaka-1209" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="row">
                                            <div class="col-lg-5 radio-group mt-5">
                                                <div class="row px-2">
                                                    <div class="col-md-8">
                                                        <form action="#">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="coupon" name="coupon" placeholder="Have any coupon?">
                                                                <button type="button" class="btn-block btn-blue">Apply</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-lg-2">

                                            </div>
                                            <div class="col-lg-4 mt-2">
                                                <div class="row d-flex justify-content-between px-4">
                                                    <p class="mb-1 text-left">Subtotal</p>
                                                    <h6 class="mb-1 text-right" id="sub_total"></h6>
                                                </div>
                                                <div class="row d-flex justify-content-between px-4">
                                                    <p class="mb-1 text-left">Shipping</p>
                                                    <h6 class="mb-1 text-right" id="shipping_cost"></h6>
                                                </div>
                                                <div class="row d-flex justify-content-between px-4" id="tax">
                                                    <p class="mb-1 text-left">Total (tax included)</p>
                                                    <h6 class="mb-1 text-right" id="total_amount"></h6>
                                                </div> <button type="submit" class="btn-block btn-blue"> <span> <span id="checkout">Place Order</span> </span> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    var sub_price = "{{ $totalAmount }}";
    $('#sub_total').text(sub_price+' Taka');
    $(document).ready(function(){

        $('.radio-group .radio').click(function(){
            $('.radio').addClass('gray');
            $(this).removeClass('gray');
        });

        $('.plus-minus .plus').click(function(){
            var count = $(this).parent().prev().text();
            $(this).parent().prev().html(Number(count) + 1);
        });

        $('.plus-minus .minus').click(function(){
            var count = $(this).parent().prev().text();
            $(this).parent().prev().html(Number(count) - 1);
        });

    });

    $("#shipping").change(function(){
        var name = $('#shipping').val();

        if (name === 'dhaka'){
            $('#shipping_cost').text('60 Taka');
            var total_price = parseInt(sub_price) + 60;
            $('#total_amount').text(total_price+' Taka');
        }else {
            $('#shipping_cost').text('100 Taka');
            var total_price = parseInt(sub_price) + 100;
            $('#total_amount').text(total_price+' Taka');
        }
    });
</script>
@endsection


