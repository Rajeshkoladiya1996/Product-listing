<table id="Producttable" class="table table-striped table-bordered dt-responsive nowrap"
    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th>#ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Buy Min Qty</th>
            <th>Buy Max Qty</th>
            <th>Category</th>
            <th>Status</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @php $n=0 @endphp
        @forelse($product as $row)
        <tr>
            <td>{{++$n}}</td>
            <td>
                @if(!empty($row->image))
                <img src="{{URL::to('storage/app/public/uploads/product/'.$row->image)}}" style="border-radius:10px" width="100px" height="100px">
                @else
                <img src="{{asset('storage/app/public/Adminassets/images/ic_logo.png')}}" width="50px"
                    style="border-radius: 50%;height:50px;">
                @endif
            </td>
            <td>{{$row->name}}</td>
            <td>{{$row->price}}</td>
            <td>{{$row->discription}}</td>
            <td>{{$row->minqty}}</td>
            <td>{{$row->maxqty}}</td>
            <td>{{$row->category->name}}</td>
            <td>
                @if($row->status == 0)
                <a href="#"><span style="cursor:pointer"
                        class="status st-8 badge badge-pill badge-success" data-id="" data-status="">Active
                    </span> </a>
                @elseif($row->status == 1)
                <a href="#"><span style="cursor:pointer"
                        class="status st-8 badge badge-pill badge-danger" data-id="" data-status="">Inactive
                    </span> </a>

                @endif
            </td>
            <td>{{ $row->created_at }}</td>
            <td>
                <a  class="edit-category btn btn-success btn-sm btn-add btn-edit-vendor"
                    href="{{ route('front.product.edit',$row->id) }}"><i class="bx bx-edit-alt"></i></a>
                <a class="btn btn-danger btn-sm btn-add btn-delete-vendor"
                    href="javascript::void(0)" data-id="{{ $row->id }}"><i class="bx bx-trash"></i></a>
            </td>
        </tr>
        </tr>
        @empty
        @endforelse
    </tbody>
</table>