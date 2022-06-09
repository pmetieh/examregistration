<!DOCTYPE html>
<html>
<head>

    @include('includes.head', array('title' => $pageTitle))
</head>
<body>
<div class="container">
    <div class="row">
        @include('includes.adminheader')
    </div>


    @yield('content')
     <div style="clear:both" class="row"></div>
    @include('includes.footer')
</div>
</body>
</html>