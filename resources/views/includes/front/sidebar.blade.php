<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="true">
                        <i class="mdi mdi-folder-heart"></i>
                        <span>Category</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false" style="">
                        <li><a href="{{ route('front.category.create') }}">Category List</a></li>
                        <li><a href="{{ route('front.category.addcategory') }}">Add New Category</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="true">
                        <i class="mdi mdi-folder-heart"></i>
                        <span>Product</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false" style="">
                        <li><a href="{{ route('front.product.create') }}">Product List</a></li>
                        <li><a href="{{ route('front.product.addproduct') }}">Add Product</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>