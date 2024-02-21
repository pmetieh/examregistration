
<nav class="navbar navbar-inverse">

    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#colaspeddiv" aria-expanded="false">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="home" style="color: red;"><img src="images/ulLogo.png" height="50px"/></a>
    </div>
    <div class="collapse navbar-collapse" id="colaspeddiv"><!-- -->
        <ul class="nav navbar-nav">
            <li  class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Manage App</a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{url('/')}}">Home</a>
                    </li>
                    <li>
                        <a href="{{url('adminDashboard')}}">Dashboard</a>
                    </li>
                </ul>
            </li>

            <li class="active dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Undergraduate Entrance Form</a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{url('inputdata')}}">BioData Form</a>
                    </li>
                    <!--<li>
                        <a href="{{ url('editdata/'.Auth::id()) }}">Edit Data</a>
                    </li>
                     <li>
                        <a href="{{ url('updatedata/'.Auth::id()) }}">Update Data</a>
                    </li>-->

                </ul>
            </li>

            <li class="active dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Graduate Entrance Form</a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{url('inputgraddata')}}">BioData Form</a>
                    </li>
                    <!--<li>
                        <a href="{{ url('editgraddata/'.Auth::id()) }}">Edit Data</a>
                    </li>
                    <li>
                        <a href="{{ url('updategraddata') }}">Update Data</a>
                    </li>-->
                </ul>
            </li>

             {{--<li class="active dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Payment</a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{url('cardpay')}}">Card Payment</a>
                    </li>
                    <li>
                        <a href="{{url('mobilemoneypayment')}}">Mobile Money Payment</a>
                    </li>
                     <li>
                        <a href="{{ url('editgraddata/'.Auth::id()) }}">Edit Data</a>
                    </li>
                   <li>
                        <a href="{{ url('updategraddata') }}">Update Data</a>
                    </li>
                </ul>
            </li>--}}


        </ul>

        <form class="navbar-form navbar-left">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search"/>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
        {{--<ul class="nav navbar-nav">
            <li><a href="">Dashboard</a></li>
        </ul>--}}
        <ul class="nav navbar-nav navbar-right">
            {{-- <li>
                 <a href="register">
                         <span class="glyphicon glyphicon-user">
                          </span>Sign Up</a>
             </li>
             <li>
                 <a href="login">
                         <span class="glyphicon glyphicon-log-in">
                          </span>Login</a>
             </li>--}}
            @if (Auth::guest())
                <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in">
                         </span>Login</a></li>
                <!--<li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user">
                         </span>Sign Up</a></li>-->
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div><!--collasped div>-->

</nav>

<script type="text/javascript">
    $(function(){

        // alert("Footer clicked");
        $("div > a").click(function(){
            // alert($(this).attr("id") + " was clicked");
            // return false;
        })

    });

    $(function(){

    });



</script>

