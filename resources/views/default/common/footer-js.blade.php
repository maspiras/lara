<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ url('/') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{ url('/') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="{{ url('/') }}/dist/js/adminlte.js"></script>
<script type="text/javascript">
	var config = {};
    config.SitePath = "{{ url('/') }}";    
</script>
@stack('scripts')