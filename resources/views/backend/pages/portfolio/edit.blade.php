@extends('backend.layouts.master')

@section('title')
    Edit Portfolio - Atiqur Rahman
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
                    <h4 class="header-title float-left mt-2 ml-3">Portfolio - {{ $portfolio->project_title }}</h4>
                    <div class="card-body">
                        <form id="block_id" class="form-main" action="{{ route('admin.portfolio.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-10 col-sm-12">
                                    <label class="col-form-label">Project Category</label>
                                    <select class="custom-select" name="category_id">
                                        <option selected="selected">Choose Project Category</option>
                                        @foreach(\App\Models\Category::all() as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ $portfolio->categories->id == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-5 col-sm-12">
                                    <label for=client_name" class="col-form-label">Client Name</label>
                                    <input type="text" name="client_name" placeholder="client_name"
                                           value="{{ $portfolio->client_name }}"class="form-control" />
                                </div>
                                <div class="form-group col-md-5 col-sm-12 ml-3">
                                    <label for=project_date" class="col-form-label">Project Date</label>
                                    <input type="date" name="project_date"  value="{{ $portfolio->project_date }}"
                                           class="form-control" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-5 col-sm-12">
                                    <label for=project_title" class="col-form-label">Project Title</label>
                                    <input type="text" name="project_title" placeholder="Project Title"
                                           value="{{ $portfolio->project_title }}" class="form-control" />
                                </div>
                                <div class="form-group col-md-5 col-sm-12 ml-3">
                                    <label for=project_url" class="col-form-label">Project Url</label>
                                    <input type="text" name="project_url" placeholder="Project url"
                                           value="{{ $portfolio->project_url }}" class="form-control" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-10 col-sm-12">
                                    <label for=project_desc" class="col-form-label">Project Description</label>
                                    <textarea name="project_desc" id="project_desc"
                                              placeholder="Project Description" class="form-control">{{ $portfolio->project_desc }}</textarea>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        @foreach($portfolio->portfolioImages as $port_img)
                                            <div class="col-md-6 mb-4">
                                                <img src="{{ asset('backend/portfolio/images/'.$port_img->image) }}" alt="">
                                                <a href="{{ route('admin.portfolio_image.destroy', $port_img->id) }}" class="btn btn-danger btn-sm mt-2">Delete</a>
                                            </div>
                                        @endforeach
                                    </div>
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
                            <div class="form-row mt-4">
                                <div class="col-md-10">
                                <button type="submit" class="btn btn-primary">Update</button>
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
