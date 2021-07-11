<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{url('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{url('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
   <!-- Select2 -->
  <link rel="stylesheet" href="{{url('plugins/select2/css/select2.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{url('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{url('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('css/admin_css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{url('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{url('plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
@include('layouts.admin_layout.admin_header')
@include('layouts.admin_layout.admin_sidebar')
  @if (session()->has('success'))
            <script type="text/javascript">
                $(function (){
                    $.notify("{{session()->get('success')}}", {globalPosition: 'top right', className: 'success'});
                });
            </script>
        @endif
        @if (session()->has('warning'))
            <script type="text/javascript">
                    $(function (){
                        $.notify("{{session()->get('warning')}}", {globalPosition: 'top right', className: 'warning'});
                    });
                </script>
        @endif
        @if (session()->has('error'))
            <script type="text/javascript">
                $(function (){
                    $.notify("{{session()->get('error')}}", {globalPosition: 'top right', className: 'error'});
                    });
            </script>
        @endif
@yield('content')

@include('layouts.admin_layout.admin_footer')
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

<script src="{{url('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{url('plugins/sparklines/sparkline.js')}}"></script>

<script src="{{url('plugins/moment/moment.min.js')}}"></script>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="{{url('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{url('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Select2 -->
<script src="{{url('plugins/select2/js/select2.full.min.js')}}"></script>

<script>
  $('.select2').select2();
  </script>
<!-- DataTables -->
<script src="{{url('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{url('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<!-- ChartJS -->
<script src="{{url('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{url('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{url('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{url('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{url('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{url('plugins/moment/moment.min.js')}}"></script>
<script src="{{url('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

<!-- Summernote -->
<script src="{{url('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('js/admin_js/adminlte.js')}}"></script>
<script src="{{url('js/admin_invoice.js')}}"></script>
<script src="{{url('js/admin_script.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<!-- AdminLTE for demo purposes -->
<script src="{{url('js/admin_js/demo.js')}}"></script>
<!--Custom Admin Js !-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
      <!-- DataTables  & Plugins -->
    <script src="{{ url('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{ url('plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{ url('plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{ url('plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- jquery-validation -->
    <script src="{{ url('plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{ url('plugins/jquery-validation/additional-methods.min.js')}}"></script>
    <!-- AdminLTE App -->
    <!-- AdminLTE for demo purposes -->
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- select 2 -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.5/handlebars.min.js" integrity="sha512-PjbpC9E7cx3jU8vrz0Bqo8DNofDrLOoV94DXxx5PK8T4udhDrUcjnEiqLA/SD6YivgHE0pwGlC8RSnwxXXXI4w==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.js"></script>
   
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false, "scrollX": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "scrollX": true,
            });
        });
    </script>
    <script type="text/javascript">
        $(function (){
            $(document).on('click', '#delete', function (e){
                e.preventDefault();
                var link = $(this).attr("href");
                 Swal.fire({
                     title: 'Are you sure?',
                     text: "You won't be able to revart this!",
                     icon: 'warning',
                     showCancelButton: true,
                     confirmButtonColor: '#3085d6',
                     cancelButtonColor: '#d33',
                     confirmButtonText: 'Yes, Delete it!'
                 }).then((result)=> {
                     if (result.value){
                         window.location.href = link;
                         Swal.fire(
                             'Deleted!',
                             'Your user has been Deleted!',
                             'success'
                         )
                     }
                 })
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function (){
            $('#image').change(function (e){
                var reader = new FileReader();
                reader.onload = function (e){
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

</body>
</html>
