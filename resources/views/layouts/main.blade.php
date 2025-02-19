<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="author" content=""/>
    <title>Polls Dashboard</title>
    <link href="{{ asset("assets/plugins/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet"/>
    <link href="{{ asset("assets/plugins/font-awesome/css/font-awesome.min.css") }}" rel="stylesheet"/>
    <link href="{{ asset("assets/plugins/simple-line-icons/css/simple-line-icons.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/plugins/ionicons/css/ionicons.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/plugins/toastr/toastr.min.css") }}" rel="stylesheet">
    <link href="{{asset("assets/plugins/morris/morris.min.css")}}" rel="stylesheet">
    <link href="{{asset("assets/css/skin/skin-midnight-blue.css")}}" rel="stylesheet" id="style-colors">
    <link href="{{ asset("assets/css/app.min.css") }}" rel="stylesheet"/>
    <link href="{{ asset("assets/css/style.css") }}" rel="stylesheet"/>
    @yield('css')
    <link rel="icon" href="{{ asset("assets/images/favicon.ico") }}" type="image/x-icon">
</head>
<body>
<div class="page-container">
    @include('components.sidebar')
    <div class="page-content">
        @include('components.header')
        <div class="page-inner">
            <div id="main-wrapper">
                @yield('content')
            </div>
        </div>
        @include('components.footer')
    </div>
</div>
@include('components.color_switcher')
<a href="#" data-click="scroll-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>
<script src="{{asset("assets/plugins/jquery/jquery.min.js")}}"></script>
<script src="{{asset("assets/plugins/jquery-ui/jquery-ui.js")}}"></script>
<script src="{{asset("assets/plugins/jquery.scrollbar/jquery.scrollbar.min.js")}}"></script>
<script src="{{asset("assets/plugins/popper/popper.js")}}"></script>
<script src="{{asset("assets/plugins/bootstrap/js/bootstrap.min.js")}}"></script>
<script src="{{asset("assets/plugins/pace/pace.min.js")}}"></script>
<script src="{{asset("assets/plugins/toastr/toastr.min.js")}}"></script>
<script src="{{asset("assets/plugins/morris/morris.min.js")}}"></script>
<script src="{{asset("assets/plugins/morris/raphael.min.js")}}"></script>
<script src="{{asset("assets/plugins/sparkline/sparkline.min.js")}}"></script>
<script src="{{asset("assets/js/jquery.slimscroll.min.js")}}"></script>
<script src="{{asset("assets/js/highlight.min.js")}}"></script>
<script src="{{asset("assets/js/adminify.js")}}"></script>
<script src="{{asset("assets/js/custom.js")}}"></script>
<script>
    // Toster Notification
    $(document).ready(function () {
        @if($errors->has('error'))
        setTimeout(function () {
            toastr.options = {
                positionClass: 'toast-top-right',
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                type: 'danger',
                message: 'Multipurpose Admin Template', 'Hi, welcome to Adminify',
                timeOut: 4000
            };
            toastr.info("{{$errors->get('error')}}");

        }, 300);
        @endif
        @if(session()->has('success'))
        setTimeout(function () {
            toastr.options = {
                positionClass: 'toast-top-right',
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
            };
            toastr.success("{{ session()->get('success') }}");

        }, 300);
        @endif
    });

</script>
@yield('js')
</body>
</html>
