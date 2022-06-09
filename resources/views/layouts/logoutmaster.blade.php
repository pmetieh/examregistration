<!doctype html>
<html>
<head>

    @include('includes.head', array('title' => $pageTitle));
</head>
<body>
<div class="container">
    <div class="row">
        @include('includes.header');
    </div>


    @yield('content');

    @include('includes.footer');
</div>
</body>
</html>