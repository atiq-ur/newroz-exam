@extends('backend.layouts.master')

@section('title')
   Product Details
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
                                    Product- {{ $product['data']['name'] }} - details</h4>
                                @include('backend.partials.message')
                            </div>
                        </div>
                        <form id="block_id" class="form-main" action="{{ route('order.cart') }}"
                              method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{  $product['data']['id'] }}" required>
                            <div class="form-row">
                                <div class="form-group col-md-10 col-sm-12">
                                    <label class="col-form-label">Choose Tastes</label>
                                    <select class="custom-select" name="taste_id" id="taste_id" required>
                                        <option selected="selected" value="">Choose Tastes</option>
                                        @foreach($tastes['data'] as $taste)
                                            <option value="{{ $taste['id'] }}">{{ $taste['taste'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="weights_group"></div>

                            <div class="form-row">
                                <div class="form-group col-md-10 col-sm-12">
                                    <label for="name">Quantity</label>
                                    <input type="number" class="form-control" name="quantity" placeholder="Quantity" id="quantity" value="" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Add To Cart</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        @include('backend.pages.orders.partials.similar_products')

    </div>
@endsection

@section('scripts')
    <script>
        var product_id = "{{ $product['data']['id'] }}";
        $("#taste_id").change(function(){
            var taste_id = $("#taste_id").val();
            $("#weights_group").html("");
            var option = "";
            $.ajax({
                url: "http://127.0.0.1:8001/api/product/"+product_id+"/tastes/"+taste_id+"/utilities",
                type: "GET",
                success: function (data){
                    for(var i= 0; i < data.data.length; i++){
                        //console.log(data.data[i].weights);
                        option +=
                            '<div class="form-check">'+
                                '<label class="form-check-label">'+
                                    '<input class="form-check-input" type="radio" required name="product_data_id" id="pro_info'+data.data[i].id+'" value="'+data.data[i].id+'">'+
                                    data.data[i].weights+'gm'+'  - Unit Price -'+data.data[i].price+' - Items left '+data.data[i].quantity+
                                '</label>'+
                            '</div>'
                    }
                    $("#weights_group").html(option);
                }
            });
        });
    </script>
@endsection
