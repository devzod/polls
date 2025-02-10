<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="author"  content=""/>
    <title>POS POLL Login</title>
    <link href="{{ asset("assets/plugins/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet"/>
    <link href="{{ asset("assets/plugins/font-awesome/css/font-awesome.min.css") }}" rel="stylesheet"/>
    <link href="{{ asset("assets/plugins/simple-line-icons/css/simple-line-icons.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/plugins/ionicons/css/ionicons.css") }}" rel="stylesheet">
    <link href="{{asset("assets/css/skin/skin-midnight-blue.css")}}" rel="stylesheet" id="style-colors">
    <link href="{{ asset("assets/css/app.min.css") }}" rel="stylesheet"/>
    <link href="{{ asset("assets/css/style.css") }}" rel="stylesheet"/>
    @yield('css')
    <link rel="icon" href="{{ asset("assets/images/favicon.ico") }}" type="image/x-icon">
</head>
<body class="card-img-2">
<div class="mg-y-120">
    @yield('content')
</div>
<script src="{{asset("assets/plugins/jquery/jquery.min.js")}}"></script>
<script src="{{asset("assets/plugins/jquery-ui/jquery-ui.js")}}"></script>
<script src="{{asset("assets/plugins/jquery.scrollbar/jquery.scrollbar.min.js")}}"></script>
<script src="{{asset("assets/plugins/popper/popper.js")}}"></script>
<script src="{{asset("assets/plugins/bootstrap/js/bootstrap.min.js")}}"></script>
<script src="{{asset("assets/plugins/pace/pace.min.js")}}"></script>
<script src="{{asset("assets/js/jquery.slimscroll.min.js")}}"></script>
<script src="{{asset("assets/js/highlight.min.js")}}"></script>
<script src="{{asset("assets/js/adminify.js")}}"></script>
<script src="{{asset("assets/js/custom.js")}}"></script>
</body>
</html>
