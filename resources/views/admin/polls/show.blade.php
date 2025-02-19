@extends('layouts.main')
@section('content')
    <div class="col-md-12 col-lg-12">
        <div class="card mb-4 shadow-1">
            <div class="card-header">
                <h4 class="card-header-title">
                    Basic Table
                </h4>
                <div class="card-header-btn">
                    <a href="javascript:void(0)" data-toggle="collapse" class="btn btn-info" data-target="#collapse1" aria-expanded="true"><i class="ion-ios-arrow-down"></i></a>
                    <a href="javascript:void(0)" data-toggle="refresh" class="btn btn-warning"><i class="ion-android-refresh"></i></a>
                    <a href="javascript:void(0)" data-toggle="expand" class="btn btn-success"><i class="ion-android-expand"></i></a>
                    <a href="javascript:void(0)" data-toggle="remove" class="btn btn-danger"><i class="ion-ios-trash-outline"></i></a>
                </div>
            </div>
            <div class="card-body collapse show" id="collapse1">
                <table class="table table-responsive-sm">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
