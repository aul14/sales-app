<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  @php
    $logo=asset(Storage::url('logo/'));
  @endphp
    @section('title')
        {{__('Login')}}
    @endsection
  <!--favicon-->
    @include('layouts.head')
</head>

<body class="{{(Utility::getValByName('style_theme')) ? Utility::getValByName('style_theme'): config()}}">

  <!-- start loader -->
  <div id="pageloader-overlay" class="visible incoming">
    <div class="loader-wrapper-outer">
      <div class="loader-wrapper-inner">
        <div class="loader"></div>
      </div>
    </div>
  </div>
  <!-- end loader -->

  <!-- Start wrapper-->
  <div id="wrapper">

    <div class="loader-wrapper">
      <div class="lds-ring">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>
    <div class="card card-authentication1 mx-auto my-5">
      <div class="card-body">
        <div class="card-content p-2">
          <div class="text-center">
            <img src="{{$logo.'/logo.png'}}" alt="logo icon">
          </div>
          <div class="card-title text-uppercase text-center py-3">Sign In</div>
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
              <label for="email" class="sr-only">Username</label>
              <div class="position-relative has-icon-right">
                <input id="email" type="email" class="form-control input-shadow @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" autocomplete="off">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="form-control-position">
                  <i class="icon-user"></i>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="password" class="sr-only">Password</label>
              <div class="position-relative has-icon-right">
                <input id="password" type="password" class="form-control input-shadow @error('password') is-invalid @enderror" name="password" placeholder="Password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="form-control-position">
                  <i class="icon-lock"></i>
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-light btn-block">Sign In</button>

          </form>
        </div>
      </div>
    </div>

    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

    <!--start color switcher-->

    <!--end color switcher-->

  </div>
  <!--wrapper-->

  <!-- Bootstrap core JavaScript-->
  @include('layouts.script')
</body>

</html>
