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
                    <h4 class="mb-0 font-size-18">@if(@$product) Edit @else Add @endif Product</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">@if(@$product) Edit @else Add @endif Product</li>
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
                    <h4 class="card-title">@if(@$product) Edit @else Add @endif Product</h4>
                    <form Action="" class="needs-validation" id="add_product" action="" enctype="multipart/form-data"
                        method="post" novalidate>
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" id="id" @if(@$product) value="{{ $product->id }}" @endif>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_name">Product Name</label>
                                    <input name="product_name" id="product_name" @if(@$product)
                                        value="{{ $product->name }}" @endif type="text" maxlength="70"
                                        class="form-control">
                                    <span id="catename1" class="text-danger">
                                    </span>
                                </div>
                            </div>


                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="product_status">Product Status</label>
                                    <select name="product_status" id="product_status" type="text" class="form-control">
                                        <option value="0" @if(isset($product))
                                            {{ $product->status == 0 ? 'selected' : '' }} @endif>Active</option>
                                        <option value="1" @if(isset($product))
                                            {{ $product->status == 1 ? 'selected' : '' }} @endif>Inactive</option>
                                    </select>
                                    <span id="product_status_error" class="text-danger">
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Price">Price</label>
                                    <input name="product_price" id="product_price" min="5" maxlength="99999"
                                        @if(@$product) value="{{ $product->price }}" @endif type="number"
                                        class="form-control">
                                    <span id="catename1" class="text-danger">
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="category_name">Description</label>
                                    <textarea class="form-control" name="description" id="description" rows="3"
                                        maxlength="300">@if(@$product){{ trim($product->discription)}}@endif</textarea>
                                    <span id="product_description1" class="text-danger">
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group quantity">
                                    <label for="Quantity">Buy Min Quantity</label>
                                    <input name="minquantity" id="minquantity" @if(isset($product))
                                        value="{{ $product->minqty}}" @endif maxlength="99999" type="number"
                                        class="form-control">
                                    <span id="quantity1" class="text-danger">
                                    </span>
                                </div>
                                <div class="form-group quantity">
                                    <label for="Quantity">Buy Max Quantity</label>
                                    <input name="maxquantity" id="maxquantity" @if(isset($product))
                                        value="{{ $product->maxqty}}" @endif maxlength="99999" type="number"
                                        class="form-control">
                                    <span id="quantity2" class="text-danger">
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_status">Category</label>

                                    <select name="category" id="category" type="text" class="form-control">

                                        @php echo $categoryTree; @endphp

                                    </select>
                                    <span id="category_status_error" class="text-danger">
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Image">Image</label>
                                    <div class="row">
                                        <div class="col-6">
                                            @if(isset($product))
                                            <div class="edit-product-image position-relative">
                                                <img id="categoryimage" @if(isset($product->image))
                                                src="{{URL::to('storage/app/public/uploads/product/'.$product->image)}}"
                                                data-src="{{URL::to('storage/app/public/uploads/product/'.$product->image)}}"
                                                height="100" width="100" @else @endif class="img-fluid old-img-preview"
                                                alt="" onerror="this.onerror=null;
                                                this.src=''">
                                                <div class="slim" data-label="Drop your Image here" data-ratio="1:1"
                                                    data-instant-edit="true">
                                                    <input type="file" name="edit_product_image"
                                                        id="edit_product_image" />
                                                </div>
                                            </div>
                                            @else
                                            <div class="slim" data-label="Drop your Image here" data-ratio="1:1"
                                                data-instant-edit="true">
                                                <input type="file" name="product_image" id="product_image" />
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <span id="product_image1" class="text-danger">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row w-100">
                            <i class='bx bx-loader bx-spin bx-flip-vertical'
                                style="font-size:30px;color:#e46b58;display:none;"></i>
                            <span id="errormsg"></span>
                        </div>
                        <button class="btn btn-primary" type="submit">@if(isset($product)) Update @else Save
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

    // Add Product Validation
    $('#add_product').validate({
        rules: {
            product_name: {
                required: true,
                regex: true,
            },
            product_status: {
                required: true,
            },
            subcategory: {
                required: true,
            },
            product_price: {
                number: true,
                required: true,
            },
            description: {
                required: true,
            },
            product_image: {
                required: true,
                extension: "jpg|jpeg|png|ico|bmp|svg|gif",
            }
        },
        messages: {
            product_name: {
                required: "Please enter Product name",
                lettersonly: "letters only"
            },
            product_status_error: {
                required: "Please select Status",

            },
            product_price: {
                required: "Please enter your price",
            },
            description: {
                required: "Please enter your description",
            },
            product_image: {
                required: "Please select image",
            }
        },
    });

    //  Add Product
    $('#add_product').submit(function(e) {
        e.preventDefault();
        var values = [];
        $('input[name="isDefault[]"]').each(function() {
            values[values.length] = (this.checked ? '1' : "0");
        });
        if ($('#add_product').valid()) {
            $('.bx-loader').show();
            var id = $('#id').val();
            if (id) {
                var url = "{{route('front.product.update')}}";

            } else {
                var url = "{{route('front.product.store')}}";
            }
            var form = $('#add_product')[0];
            var formData = new FormData(form);
            formData.append('isdefault', values);
            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('.bx-loader').hide();
                    if (data.status == 200) {
                        window.location.href = "{{url('/')}}";
                    } else {
                        $('.slim-result img').removeAttr('src');
                        $('.slim-btn-group').css("display", 'none');
                        $("#add_product")[0].reset();
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