<html>
<head>
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/img/twitter.png" type="image/x-icon" rel="shortcut icon">
    <link href="/css/index.css" type="text/css" rel="stylesheet">
    <link href="/css/app.css" type="text/css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
</head>
<body>
    @section('menubar')
    <div class="header">
    	<a href="/tweet"><h1>Laravel</h1></a>
        @if (Auth::check())
            <div id="header_right">
                <p>{{$user->name}} <span> ▼</span></p>
            </div>
        @else       
        @endif
    </div>
    <div class="header_list">
        <a href="/user_logout"><h2>ログアウト</h2></a>
    </div>
    <ul>
        <p>@show</p>
    </ul>
    <div class="content">
    @yield('content')
    </div>
    <div class="footer">
    @yield('footer')
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/header.js"></script>
    <script type="text/javascript" src="js/timeline.js"></script>
    <script type="text/javascript" src="js/Ajax.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/like.js') }}"></script>
    <script>
      var token = '{{ Session::token() }}';
      var urlLike = '{{ route('like') }}';
    </script>
</body>
</html>