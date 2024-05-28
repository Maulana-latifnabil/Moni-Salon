@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Error 403: Unauthorized</h1>
    </div>

    <!-- Error Message Row -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Unauthorized Access</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $exception }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Dashboard Button -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <a href="{{ route('home') }}" class="btn btn-primary btn-block">Back to Dashboard</a>
        </div>
    </div>
</div>
@endsection
