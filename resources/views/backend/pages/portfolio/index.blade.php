@extends('backend.layouts.master')

@section('title')
    Portfolio - Atiqur Rahman
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
                            <h5 class="modal-title">New Portfolio</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form id="block_id" class="form-main" action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-10 col-sm-12">
                                        <label class="col-form-label">Project Category</label>
                                        <select class="custom-select" name="category_id">
                                            <option selected="selected">Choose Project Category</option>
                                            @foreach(\App\Models\Category::all() as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-5 col-sm-12">
                                        <label for=client_name" class="col-form-label">Client Name</label>
                                        <input type="text" name="client_name" placeholder="client_name" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-5 col-sm-12 ml-3">
                                        <label for=project_date" class="col-form-label">Project Date</label>
                                        <input type="date" name="project_date"  class="form-control" />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-5 col-sm-12">
                                        <label for=project_title" class="col-form-label">Project Title</label>
                                        <input type="text" name="project_title" placeholder="Project Title" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-5 col-sm-12 ml-3">
                                        <label for=project_url" class="col-form-label">Project Url</label>
                                        <input type="text" name="project_url" placeholder="Project url" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for=project_desc" class="col-form-label">Project Description</label>
                                        <textarea name="project_desc" id="project_desc" placeholder="Project Description" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-row" id="dynamic_field">
                                    <div class="col-md-10">
                                        <label for=images[]" class="col-form-label">Project Image</label>
                                        <input type="file" name="images[]" class="form-control" />
                                    </div>
                                    <div class="col-md-2" style="margin-top: 38px;">
                                        <button type="button" name="add" id="add" class="btn btn-info button-more"><i class="fa fa-plus-circle"></i></button>
                                    </div>
                                </div>
                                {{--<div class="form-row " id="dynamic_field">
                                    <div class="form-group col-md-8 col-sm-12">
                                        <label for="name">মহল্লা/ব্লক/রাস্তা এর নাম</label>
                                        <input type="text" name="name[]" placeholder="মহল্লা/ব্লক/রাস্তা এর নাম দিন" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-4 col-sm-12">
                                        <button type="button" name="add" id="add" class="btn btn-info button-more"><i class="fa fa-plus-circle"></i></button>
                                    </div>

                                </div>--}}
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
                        <h4 class="header-title float-left">Portfolio</h4>
                        <p class="float-right mb-2">
                            <a class="btn btn-primary text-white" href="#bd-example-modal-lg" data-toggle="modal" data-target=".bd-example-modal-lg">Add New</a>
                        </p>
                        <div class="data-tables datatable-primary">
                            <table id="dataTable2" class="text-center">
                                <thead class="text-capitalize">
                                <tr>
                                    <th width="5%">Sl</th>
                                    <th width="5%">Category</th>
                                    <th width="15%">Client Name</th>
                                    <th width="20%">Project Title</th>
                                    <th width="10%">Project Date</th>
                                    <th width="5%">Project Url</th>
                                    <th width="25%">Project Details</th>
                                    <th width="10%">Created at</th>
                                    <th width="10%">Updated at</th>
                                    <th width="5%">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach (\App\Models\Portfolio::with('categories')->get() as $port)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $port->categories->name }}</td>
                                        <td>{{ $port->client_name }}</td>
                                        <td>{{ $port->project_title }}</td>
                                        <td>{{ \Carbon\Carbon::parse($port->project_date)->format('d M Y') }}</td>
                                        <td>
                                            <a href="https://{{ $port->project_url }}" target="_blank">{{ $port->project_url }}</a>
                                        </td>
                                        <td>
                                            <textarea cols="30" rows="2">{{ $port->project_desc }}</textarea>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($port->updated_at)->format('d M Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($port->created_at)->format('d M Y') }}</td>
                                        <td>
                                            <a class="btn btn-success text-white" href="{{ route('admin.portfolio.edit', $port->id) }}">View Details</a>
                                            <a href="#deleteModal-{{ $port->id }}" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $port->id }}">Delete</a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="deleteModal-{{ $port->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <form action="{{ route('admin.portfolio.destroy', $port->id) }}" method="POST">
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
