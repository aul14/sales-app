@extends('layouts.global')
@section('title')
Home
@endsection
@section('content')
<div class="row mt-3">
    <div class="col-12 col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="w-icon">
                        <i class="fa fa-user-o text-primary"></i>
                    </div>
                    <div class="media-body ml-3 border-left-xs border-light-3">
                        <h4 class="mb-0 ml-3">{{ $data['user_count'] }}</h4>
                        <p class="mb-0 ml-3 extra-small-font">User</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="w-icon">
                        <i class="fa fa-tag text-primary"></i>
                    </div>
                    <div class="media-body ml-3 border-left-xs border-light-3">
                        <h4 class="mb-0 ml-3">4</h4>
                        <p class="mb-0 ml-3 extra-small-font">Post</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="w-icon">
                        <i class="fa fa-user text-primary"></i>
                    </div>
                    <div class="media-body ml-3 border-left-xs border-light-3">
                        <h4 class="mb-0 ml-3">3</h4>
                        <p class="mb-0 ml-3 extra-small-font">Customer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="w-icon">
                        <i class="fa fa-pinterest-p text-primary"></i>
                    </div>
                    <div class="media-body ml-3 border-left-xs border-light-3">
                        <h4 class="mb-0 ml-3">2</h4>
                        <p class="mb-0 ml-3 extra-small-font">Product</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div><!--end row-->


@endsection
