@extends('layouts.front')
@section('title')
Product list
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Product list</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Product list</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if(Session::has('message'))
                {!! Session::get('message') !!}
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                            </div>
                            <div class="col-sm-8">
                            <div class="text-sm-right">
                                    <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2" href="{{route('front.product.addproduct')}}">
                                        <i class="mdi mdi-plus mr-1"></i>
                                        Add Product
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div id="categorylist">
                            @include('front.product.productlist')
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>

@endsection
@section('js')

<script src="{{URL::to('storage/app/public/Adminassets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::to('storage/app/public/Adminassets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}">
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Buttons examples -->
<script
    src="{{URL::to('storage/app/public/Adminassets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}">
</script>
<script
    src="{{URL::to('storage/app/public/Adminassets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}">
</script>

<script type="text/javascript">
    //Stream Table
    $("#Producttable").DataTable();


// delete category 
$('body').on('click','.btn-delete-vendor',function(e){
   var id = $(this).data('id');
   var url = "{{URL::to('/product/destroy')}}"+'/'+id;
    swal({
            title: "Are You Sure Want to Delete Product ?",
            text: "Once deleted you will not be able to recover this record!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                swal("Product has been deleted!", {
                icon: "success",
                });
               window.location.href = url;
            } else {
             
            }
    });
});
// end delete category
</script>

@endsection