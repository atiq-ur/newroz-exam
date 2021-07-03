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
            <div class="modal fade bd-example-modal-lg ml-5">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">New Offer</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form id="block_id" class="form-main" action="{{ route('preOrder.offers.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-8 col-sm-12">
                                        <label for=name" class="col-form-label">Offer Name</label>
                                        <input type="text" name="name" placeholder="name" class="form-control"  required/>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8 col-sm-12">
                                        <label for=minimum_order_quantity" class="col-form-label">Minimum Order Of Quantity</label>
                                        <input type="number" name="minimum_order_quantity" placeholder="minimum_order_quantity" class="form-control" required/>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8 col-sm-12">
                                        <label for=fixed_amount" class="col-form-label">Fixed Amount (If choose Percentage then ignore this input)</label>
                                        <input type="number" name="fixed_amount" placeholder="fixed_amount" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8 col-sm-12">
                                        <label for=percentage" class="col-form-label">Offer Percentage (If choose Percentage then ignore this input)</label>
                                        <input type="number" name="percentage" placeholder="percentage" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="example-datetime-local-input" class="col-form-label">Start Time</label>
                                        <input class="form-control" name="start_time" type="datetime-local" value="2021-07-01T15:30:00" id="example-datetime-local-input" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="example-datetime-local-input" class="col-form-label">End Time</label>
                                        <input class="form-control" name="end_time" type="datetime-local" value="2021-07-01T15:30:00" id="example-datetime-local-input" required>
                                    </div>
                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Primary table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title float-left">Offers </h4>
                        <p class="float-right mb-2">
                            <a class="btn btn-primary text-white" href="#bd-example-modal-lg" data-toggle="modal" data-target=".bd-example-modal-lg">Add New</a>
                        </p>
                        <div class="data-tables datatable-primary">
                            <table id="dataTable2" class="text-center">
                                <thead class="text-capitalize">
                                <tr>
                                    <th width="5%">Sl</th>
                                    <th width="15%">Offer Name</th>
                                    <th width="10%">Min Order Qty</th>
                                    <th width="12%">Start Time</th>
                                    <th width="12%">End Time</th>
                                    <th width="20%">Offer Status</th>
                                    <th width="15%">Offer Added Date</th>
                                    <th width="10%">Actions</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($offers['data'] as $offer)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td> {{ $offer['name'] }}</td>
                                        <td> {{ $offer['minimum_order_quantity'] }}</td>
                                        <td> {{ $offer['start_time'] }}</td>
                                        <td> {{ $offer['end_time'] }}</td>
                                       <td>
                                           @if($offer['isActive'])
                                               <button class="btn-sm btn-success mr-2" disabled><i class="ti-arrow-circle-right"></i></button>
                                               <a href="{{ route('offer.change_status', $offer['id']) }}" class="text-danger"><i class="ti-close"></i></a>
                                           @else
                                               <button class="btn-sm text-white bg-danger mr-2" disabled><i class="ti-close"></i> </button>
                                               <a href="{{ route('offer.change_status', $offer['id']) }}" class="btn-sm text-info"><i class="ti-arrow-circle-right"></i></a>
                                           @endif
                                       </td>
                                        <td> {{ \Carbon\Carbon::parse($offer['created_at'])->format('D M Y') }}</td>

                                        <td>
                                            <a class="text-success mr-2" href="{{ route('preOrder.offers.edit',
                                              $offer['id']) }}"><i class="ti-pencil-alt"></i></a>
                                            <a href="#deleteModal-{{  $offer['id'] }}" class="text-danger" data-toggle="modal"
                                               data-target="#deleteModal-{{  $offer['id'] }}"><i class="ti-trash"></i></a>
                                        </td>

                                    </tr>
                                    <div class="modal fade" id="deleteModal-{{  $offer['id']  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation !!</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure to delete ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <form action="{{ route('preOrder.offers.destroy', $offer['id']) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
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
