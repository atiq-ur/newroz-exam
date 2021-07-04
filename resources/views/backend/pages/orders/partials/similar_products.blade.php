<hr>
@php
    $getCurrentProductTaste = \App\Models\OrderProduct::
        getCurrentProductTastes($product['data']['id']);
@endphp

@if($getCurrentProductTaste != null)
    <div class="row">
        <div class="card">
            <div class="col-md-12">
                <div class="card-title ml-5">
                    <h3 class="text-sm-center mb-2">You May like</h3>
                    <h6 class="text-sm-center">You have another item with same taste. You can purchase it.</h6>

                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        @foreach($getCurrentProductTaste['data'] as $taste)
            @php
                $getProductData = \App\Models\OrderProduct::
                    getProductData($product['data']['id'], $taste['id']);
            @endphp

            @if($getProductData)
                @foreach($getProductData['data'] as $pro_data)
                    @if($taste['id'] ==$pro_data['taste_id'] && $pro_data['quantity'] > 0)
                        <div class="col-sm-6 col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Product - {{ $product['data']['name'] }}</h4>
                                    <h6>Taste -{{ $taste['taste'] }}</h6>
                                    <p class="card-text">Some Info about Product.</p>
                                    <a href="{{ route('order.details', $product['data']['name']) }}" class="btn btn-primary">View</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif

        @endforeach
    </div>
@endif
