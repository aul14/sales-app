<script src="{{ asset('assets/js/jquery.min.js')}}"></script>
<script src="{{ asset('assets/js/popper.min.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/plugins/simplebar/js/simplebar.js')}}"></script>
<script src="{{ asset('assets/js/sidebar-menu.js')}}"></script>
<script src="{{ asset('assets/js/app-script.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap-fileinput.js')}}"></script>
<script src="{{ asset('assets/js/toastr.min.js')}}"></script>
<script src="{{ asset('assets/plugins/jquery.toast.min.js')}}"></script>
  <script>
    @if (Session::has('success'))
    toastr.success("{{ Session::get('success')}}")
    @endif
    </script>
    <script>
    @if (Session::has('error'))
    toastr.error("{{ Session::get('error')}}")
    @endif
    </script>
    @yield('script')


