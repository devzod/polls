@extends('layouts.main')
@section('content')
    <div class="row clearfix">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-teal mb-4 shadow-1">
                <div class="card-body card-img">
                    <div class="card-icon">
                        <i class="ion-ios-analytics float-right"></i>
                    </div>
                    <div class="text-white">
                        <h6 class="mb-0 text-uppercase tx-13">Orders</h6>
                        <h4 class="mg-b-40">587</h4>
                        <span class="badge badge-warning ft-right mg-r-10"> +31% </span> <span>From previous period</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger mb-4 shadow-1">
                <div class="card-body card-img">
                    <div class="card-icon">
                        <i class="ion-ios-basketball-outline float-right"></i>
                    </div>
                    <div class="text-white">
                        <h6 class="mb-0 text-uppercase tx-13">Revenue</h6>
                        <h4 class="mg-b-40">$4,746</h4>
                        <span class="badge badge-info ft-right mg-r-10"> -15% </span> <span>From previous period</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary mb-4 shadow-1">
                <div class="card-body card-img">
                    <div class="card-icon">
                        <i class="ion-ios-lightbulb-outline float-right"></i>
                    </div>
                    <div class="text-white">
                        <h6 class="mb-0 text-uppercase tx-13">Average Price</h6>
                        <h4 class="mg-b-40">$24.4</h4>
                        <span class="badge badge-warning ft-right mg-r-10"> 10% </span> <span>From previous period</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info mb-4 shadow-1">
                <div class="card-body card-img">
                    <div class="card-icon">
                        <i class="ion-ios-pie-outline float-right"></i>
                    </div>
                    <div class="text-white">
                        <h6 class="mb-0 text-uppercase tx-13">Product Sold</h6>
                        <h4 class="mg-b-40">$2,390</h4>
                        <span class="badge badge-danger ft-right mg-r-10"> +67% </span> <span>From previous period</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>

    </script>
@endsection
