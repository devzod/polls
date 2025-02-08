<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="author" content=""/>
    <title>POS POLL Dashboard</title>
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
                <div class="pageheader pd-y-25">
                    <div class="pd-t-5 pd-b-5">
                        <h1 class="pd-0 mg-0 tx-20 text-overflow">Dashboard</h1>
                    </div>
                    @include('components.breadcrumbs')
                </div>
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
    // $(document).ready(function () {
    //     setTimeout(function () {
    //         toastr.options = {
    //             positionClass: 'toast-top-right',
    //             closeButton: true,
    //             progressBar: true,
    //             showMethod: 'slideDown',
    //             timeOut: 5000
    //         };
    //         toastr.info('Multipurpose Admin Template', 'Hi, welcome to Adminify');
    //
    //     }, 300);
    //
    // });

</script>
@yield('js')
</body>
</html>
