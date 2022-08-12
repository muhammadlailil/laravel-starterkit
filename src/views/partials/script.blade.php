@stack('variable_js')
<script>
    const BASE_URL = "{{url('')}}";
</script>
<script src="{{asset('vendor/starterkit/js/jquery.3.2.1.min.js')}}"></script>
<script src="{{asset('vendor/starterkit/js/popper.min.js')}}"></script>
<script src="{{asset('vendor/starterkit/js/bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="{{asset('vendor/starterkit/js/jquery.scrollbar.min.js')}}"></script>
<script src="{{asset('vendor/starterkit/js/jquery-sortable-min.js')}}"></script>
<script src="{{asset('vendor/starterkit/js/atlantis.min.js')}}"></script>
<script src="{{asset('vendor/starterkit/js/jquery.sumoselect.js')}}"></script>
<script src="{{asset('vendor/starterkit/js/sweetalert.min.js')}}"></script>
<script src="{{asset('vendor/starterkit/js/lightpick.js')}}"></script>
<script src="{{asset('vendor/starterkit/js/jquery.timepicker.js')}}"></script>
<script src="{{asset('vendor/starterkit/js/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('vendor/starterkit/js/main.js')}}"></script>
<script>
    function confirmLogout() {
        confirmAlert('Apakah anda yakin ingin keluar dari halaman ini?', () => {
            window.location.href = "{{route('admin.logout')}}"
        })
    }
</script>