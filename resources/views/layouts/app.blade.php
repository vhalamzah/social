<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>tsb markets</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                       tsb markets
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            @if (Auth::check())
                            <li><a href="{{route('dashboard.profile', Auth::user()->id)}}">profile</a></li>
                            <li><a href="{{url('/find/friends')}}">Find Friends </a></li>
                              <li><a href="{{route('see.friend.requests')}}">My Requests
                                      <span style="color:green; font-weight:bold;
                                       font-size:16px">({{App\Friendship::where('status', Null)
                                                  ->where('user_requested', Auth::user()->id)
                                                  ->count()}})</span></a></li>
                                                  <li><a href="{{route('see.friends')}}">friends</a></li>
                                                   <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                   role="button" aria-expanded="false">
                                    <i class="fa fa-globe fa-2x" aria-hidden="true"></i>
                                    <span class="badge"
                                          style="background:red; position: relative; top: -15px; left:-10px">
                                 {{App\Notification::where('status', null)
                                     ->where('user_hero', Auth::user()->id)
                                      ->count()}}
                                    </span>
                                </a>
                                   <?php
                                   $notes = DB::table('users')
                                        ->leftJoin('notifications', 'users.id', 'notifications.user_logged')
                                    ->where('user_hero', Auth::user()->id)
                                           ->orderBy('notifications.created_at', 'desc')
                                    ->get();
                                   ?>

                                   <ul class="dropdown-menu" role="menu" style="width:320px">
                                       @foreach($notes as $note)
                                          <a href="{{url('/notifications')}}/{{$note->id}}">
                                            @if($note->status==1)
                                        <li style="background:#E4E9F2; padding:10px">
                                          @else
                                          <li style="padding:10px">
                                            @endif
                                         <div class="row">
                                          <div class="col-md-2">
                                            <img src="{{url('../')}}/public/img/{{$note->pic}}"
                                             style="width:50px; padding:5px; background:#fff; border:1px solid #eee" class="img-rounded">
                                          </div>

                                        <div class="col-md-10">

                                         <b style="color:green; font-size:90%">{{ucwords($note->name)}}</b>
                                          <span style="color:#000; font-size:90%">{{$note->note}}</span>
                                          <br/>
                                          <small style="color:#90949C"> <i aria-hidden="true" class="fa fa-users"></i>
                                            {{date('F j, Y', strtotime($note->created_at))}}
                                          at {{date('H: i', strtotime($note->created_at))}}</small>
                                        </div>

                                        </div>
                                        </li></a>
                                       @endforeach
                                   </ul>
                                </li>

                        <!--<li>  <a href="#{{url('jobs')}}"  style="background-color:#283E4A; color:#fff; padding:5px 15px 5px 15px; border-radius:5px; margin:8px">Find Job</a></li>
                        <li><a href="#"></a></aside></li>-->
                            @endif
                        </ul>

                    

                     <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                   
                        <li></li>
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                         <li> <a href="">
                                <img src="{{URL::to('/')}}/img/{{Auth::user()->pic}}" width="30px" height="30px" class="img-circle"/>
                               </a>  
                        </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                
                                <ul class="dropdown-menu" role="menu">
                                    <li>                                        <a href="{{route('dashboard.profile', Auth::user()->id)}}">profile</a></li>    
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
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
