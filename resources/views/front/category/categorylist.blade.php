<table id="Producttable" class="table table-striped table-bordered dt-responsive nowrap"
    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th>#ID</th>
            <th>Name</th>

            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @php $n=0 @endphp
        @forelse($category as $row)
        <tr>
            <td>{{++$n}}</td>

            <td>{{$row->name}}</td>



            <td>
                <a  class="edit-category btn btn-success btn-sm btn-add btn-edit-vendor"
                    href="{{ route('front.category.editcategory',$row->id) }}"><i class="bx bx-edit-alt"></i></a>
                <a class="btn btn-danger btn-sm btn-add btn-delete-vendor"
                    href="javascript::void(0)" data-id="{{ $row->id }}"><i class="bx bx-trash"></i></a>
            </td>
        </tr>
        </tr>
        @empty
        @endforelse
    </tbody>
</table>