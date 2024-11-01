
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('default.common.head')
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Main Sidebar Container -->
  @include('default.common.navigation')

  @yield('content')


  @include('default.common.footer')
  
</div>
<!-- ./wrapper -->
@include('default.common.footer-js')

</body>
</html>
