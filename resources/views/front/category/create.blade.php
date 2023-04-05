@extends('layouts.front')
@section('title')
@if(@$product) Edit @else Add @endif Product
@endsection
@section('css')
<link rel="stylesheet" type="text/css"
    href="{{URL::asset('storage/app/public/Adminassets/css/image-uploader.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('storage/app/public/Adminassets/css/slim.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('storage/app/public/Adminassets/css/semantic.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('storage/app/public/Adminassets/css/custom.css')}}">
@endsection
@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">@if(@$category) Edit @else Add @endif Category</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">@if(@$category) Edit @else Add @endif Category</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 err-msg">
                @if(Session::has('message'))
                {!! Session::get('message') !!}
                @endif
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">@if(@$category) Edit @else Add @endif Category</h4>
                    <form Action="" class="needs-validation" id="add_category" action="" enctype="multipart/form-data"
                        method="post" novalidate>
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" id="id" @if(@$category) value="{{ $category->id }}" @endif>
                            <div class="col-md-6">
                                <div class="form-group">


                                    <label for="category_name">Category Name</label>
                                    <input name="category_name" id="category_name" @if(@$category)
                                        value="{{ $category->name }}" @endif type="text" maxlength="70"
                                        class="form-control">
                                    <span id="catename1" class="text-danger">
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_status">Category</label>

                                    <select name="category" id="category" type="text" class="form-control">
                                        <option value="0">Select option</option>
                                        @php echo $categoryTree;  @endphp

                                    </select>
                                    <span id="category_status_error" class="text-danger">
                                    </span>
                                </div>
                            </div>

                        <div class="row w-100">
                            <i class='bx bx-loader bx-spin bx-flip-vertical'
                                style="font-size:30px;color:#e46b58;display:none;"></i>
                            <span id="errormsg"></span>
                        </div>
                        <button class="btn btn-primary" type="submit">@if(isset($category)) Update @else Save
                            @endif</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('js')
    <script src="{{URL::to('storage/app/public/Adminassets/js/slim.kickstart.min.js')}}"></script>
    <script src="{{URL::to('storage/app/public/Adminassets/js/semantic.min.js')}}"></script>
    <script type="text/javascript">
    // jquery validation
    jQuery.validator.addMethod("regex", function(value, element, regexpr) {
        return this.optional(element) || /^[a-zA-Z0-9 ]+$/u.test(value);
    }, "Letters and numbers only");

    // Add category Validation
    $('#add_category').validate({
        rules: {
            category_name: {
                required: true,
                regex: true,
            },
            category: {
                required: true,
            }
        },
        messages: {
            category_name: {
                required: "Please enter Category name",
                lettersonly: "letters only"
            },
            category: {
                required: "Select Category",

            }

        },
    });

    //  Add Product
    $('#add_category').submit(function(e) {
        e.preventDefault();


        if ($('#add_category').valid()) {
            $('.bx-loader').show();
            var id = $('#id').val();
            if (id) {
                var url = "{{route('front.category.update')}}";

            } else {
                var url = "{{route('front.category.store')}}";
            }
            var form = $('#add_category')[0];
            var formData = new FormData(form);
            formData.append('id', id);
            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('.bx-loader').hide();
                    if (data.status == 200) {
                        window.location.href = "{{url('/categorylist')}}";
                    } else {

                        $("#add_category")[0].reset();
                    }

                },
                error: function(error) {
                    $('.bx-loader').hide();
                    $.each(error.responseJSON.errors, function(key, value) {
                        $(".err-msg").html(
                            '<div class="alert alert-danger"><strong>Error! </strong>' +
                            value + '</div>');
                    });
                    $('.addcategory').modal('hide');
                }
            });
        }
        return false;
    });
    </script>
    @endsection