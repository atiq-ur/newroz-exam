@extends('backend.layouts.master')

@section('title')
    Ordered Lists - Newroz
@endsection

@section('admin-page-content')
    <div class="main-content-inner">
        <div class="row">
            <!-- Primary table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title float-left">Ordered Lists</h4>
                        <p class="float-right mb-2">
                            <a class="btn btn-primary text-white" href="#bd-example-modal-lg" data-toggle="modal" data-target=".bd-example-modal-lg">Add New</a>
                        </p>
                        <div class="data-tables datatable-primary">
                            <table id="dataTable2" class="text-center">
                                <thead class="text-capitalize">
                                <tr>
                                    <th width="5%">Sl</th>
                                    <th width="10%">Order ID</th>
                                    <th width="15%">Customer Name</th>
                                    <th width="25%">Order Status</th>
                                    <th width="15%">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orderLists as $order)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td># {{ $order->order_id }}</td>
                                        <td>{{ $order->customer_name }}</td>
                                        <td>
                                            @if($order->order_status == 0)
                                                   <button type="button" class="btn btn-sm btn-warning" disabled>Pending</button>
                                            @elseif($order->order_status == 1)
                                                <button type="button" class="btn btn-sm btn-primary" disabled>Confirmed</button>
                                                <button type="button" class="btn btn-sm btn-warning" disabled>Not Delivered Yet</button>
                                            @elseif($order->order_status == 2)
                                                <button type="button" class="btn btn-sm btn-danger" disabled>Cancelled</button>
                                            @elseif($order->order_status == 4)
                                                <button type="button" class="btn btn-sm btn-primary" disabled>Confirmed</button>
                                                <button type="button" class="btn btn-sm btn-primary" disabled>Disbursed</button>
                                            @elseif($order->order_status == 5)
                                                <button type="button" class="btn btn-sm btn-primary" disabled>Cancelled</button>
                                                <button type="button" class="btn btn-sm btn-danger" disabled>Cancelled Deliver</button>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn text-dark" href="{{ route('order.view', $order) }}"><i class="ti-eye"></i></a>
                                            <a class="btn text-danger" href="{{ route('order.destroy', $order->id) }}"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            var i=1;
            $('#add').click(function(){

                i++;
                $('#dynamic_field').append('' +
                    '<div class="col-md-10" id="row'+i+'">' +
                    '<label for=image" class="col-form-label">Project Image '+i+'</label>'+

                    '<input id="image" type="file" name="images[]" class="form-control" />' +
                    '</div>' +
                    '</div>'+
                    '<div class="col-md-2" style="margin-top: 38px;" id="row2'+i+'">'+
                    '<button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove button-more">X</button>' +
                    '</div>'
                );
            });
            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
                $('#row2'+button_id+'').remove();
            });
        });
    </script>
@endsection
