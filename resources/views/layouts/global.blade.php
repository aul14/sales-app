<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!--favicon-->
  @yield('css')
  @include('layouts.head')
</head>

<body class="{{(Utility::getValByName('style_theme')) ? Utility::getValByName('style_theme'): config()}}">
   <div id="pageloader-overlay" class="visible incoming">
       <div class="loader-wrapper-outer">
           <div class="loader-wrapper-inner" >
               <div class="loader">
                </div>
            </div>
        </div>
    </div>

<div id="wrapper">
        @include('layouts.navbar')
        @include('layouts.topbar')

        <div class="clearfix"></div>

        <div class="content-wrapper">
            <div class="container-fluid">
            @yield('content')
            <div class="overlay toggle-menu"></div>
            </div>
        </div>

        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>

</div>

  {{-- @include('layouts.footer') --}}

        @include('layouts.script')
</body>
</html>
