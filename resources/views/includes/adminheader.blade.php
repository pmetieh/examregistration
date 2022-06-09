
<nav class="navbar navbar-inverse">

    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#colaspeddiv" aria-expanded="false">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#" style="color: red;">Admin Dashboard</a>
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
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Manage Roles<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{url('assignrole')}}">Assign Role</a></li>
                    <li><a href="{{url('createroleview')}}">Create Role</a></li>
                    <li><a href="{{url('deleteroleview')}}">Delete Role</a></li>
                    <li><a href="{{url('assignrole')}}">Role Assignment</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="/dropdown-toggle" data-toggle="dropdown">Manage Major<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li> <a href="{{url('listmajor')}}">Add Major</a></li>
                    {{-- <li> <a href="{{url('viewemployee/'.Auth::user()->id)}}">View Employee</a></li> --}}
                    <li> <a href="{{url('')}}">Edit Major</a></li>
                    <li> <a href="{{url('')}}">Delete Major</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">HighSchool/Colleges<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{url('addCollege')}}">Add College</a></li>
                    <li><a href="{{url('editCollege')}}">Edit College</a></li>
                    <li><a href="{{url('dropCollege')}}">Remove College</a></li> 
                    <li><a href="{{url('addHSch')}}">Add HighSchool</a></li>
                    <li><a href="{{url('editHSch')}}">Edit HighSchool</a></li>
                    <li><a href="{{url('dropHSch')}}">Remove HighSchool</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Convert To Excel<span class="caret"></span></a>
                <ul class="dropdown-menu">
                     <li>
                        <a href="{{ url('excelugrad') }}">Excel Undergrad Data</a>
                    </li>
                     <li>
                        <a href="{{ url('excelgrad') }}">Excel Grad Data</a>
                    </li>
                    <li>
                        <a href="{{ url('regUgrad') }}">Registered Undergraduates</a>
                    </li>
                    <li>
                        <a href="{{ url('regGrad') }}">Registered Graduates</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Magage Testing Centers<span class="caret"></span></a>
            <ul class="dropdown-menu">
                    <li><a href="{{url('addtc')}}">Add Testing Center</a></li>
                    <li><a href="{{url('edittc')}}">Edit Testing Center</a></li>
                    <li><a href="{{url('addDateView')}}">Add Testing Date</a></li>
                    <li><a href="{{url('editDate')}}">Edit Testing Date</a></li>
                </ul>
            </li>

        </ul>



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
             </li>--}}{{--
            @if (Auth::guest())
                <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in">
                         </span>Login</a></li>
                <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user">
                         </span>Sign Up</a></li>
            @else --}}
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
        {{-- @endif--}}
        </ul>
    </div><!--collasped div>-->

</nav>
