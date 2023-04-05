<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<!-- Admin Head -->
@include('includes.front.head')
<body data-sidebar="dark">
    <div id="layout-wrapper">
    
        @include('includes.front.header')

        @include('includes.front.sidebar')
        <div class="main-content">
      
            @yield('content')

            @include('includes.front.footer')
        </div>
                  
    </div>
    @include('includes.front.script')
    
</body>

</html>
