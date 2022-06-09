<!doctype html>
<html>
<head>

       @include('includes.head', array('title' => $pageTitle))
</head>
<body>
<div class="container">
    <div class="row">
        @include('includes.paymentheader')
    </div>
    	@include('messages.flash-message')

        @yield('content')

    @include('includes.footer')
</div>
</body>
</html>