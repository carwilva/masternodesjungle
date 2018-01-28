<!DOCTYPE html>
<html lang="en">


<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
  <title>Masternodesjangle Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,700' rel='stylesheet' type='text/css'>

  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">



  <!-- Font Awesome -->
  <link href="/admin_assets/css/styles.css" type="text/css" rel="stylesheet">
  <!-- Core CSS with all styles -->

  <link href="/admin_assets/plugins/jstree/dist/themes/avalon/style.min.css" type="text/css" rel="stylesheet">
  <!-- jsTree -->
  <link href="/admin_assets/plugins/codeprettifier/prettify.css" type="text/css" rel="stylesheet">
  <!-- Code Prettifier -->
  <link href="/admin_assets/plugins/iCheck/skins/minimal/blue.css" type="text/css" rel="stylesheet">
  <link href="/admin_assets/plugins/pines-notify/pnotify.css" type="text/css" rel="stylesheet">
  @yield('style')
</head>

<body class="infobar-offcanvas">
    @include('admin.partials.header')
    <!-- Main content starts -->
    @yield('content')
    <div class="panel-body table-responsive bash-table-wrap">
      <div class="panel panel-default">
        <table class="table table-bordered">
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
    <!-- Main content starts -->
    @include('admin.partials.footer')


  <script src="/admin_assets/js/jquery-1.10.2.min.js"></script>
  <!-- Load jQuery -->
  <script src="/admin_assets/js/jqueryui-1.9.2.min.js"></script>
  <!-- Load jQueryUI -->
  <script src="/admin_assets/js/bootstrap.min.js"></script>
  <!-- Load Bootstrap -->
  <script src="/admin_assets/plugins/sparklines/jquery.sparklines.min.js"></script>
  <!-- Sparkline -->
  <script src="/admin_assets/plugins/jstree/dist/jstree.min.js"></script>
  <!-- jsTree -->
  <script src="/admin_assets/plugins/codeprettifier/prettify.js"></script>
  <!-- Code Prettifier  -->
  <script src="/admin_assets/plugins/bootstrap-switch/bootstrap-switch.js"></script>
  <!-- Swith/Toggle Button -->
  <script src="/admin_assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"></script>
  <!-- Bootstrap Tabdrop -->
  <script src="/admin_assets/plugins/iCheck/icheck.min.js"></script>
  <!-- iCheck -->
  <script src="/admin_assets/js/enquire.min.js"></script>
  <!-- Enquire for Responsiveness -->
  <script src="/admin_assets/plugins/bootbox/bootbox.js"></script>
  <!-- Bootbox -->
  <script src="/admin_assets/plugins/simpleWeather/jquery.simpleWeather.min.js"></script>
  <!-- Weather plugin-->
  <script src="/admin_assets/js/application.js"></script>
  <script src="/admin_assets/demo/demo.js"></script>

  <script src="/admin_assets/plugins/easypiechart/jquery.easypiechart.js"></script>
  <script src="/admin_assets/plugins/pines-notify/pnotify.min.js"></script>
    <script type="text/javascript">
        /* it is used to do azax function in laravel. */
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        
    </script>
    @yield('script')
</body>
</html>
  