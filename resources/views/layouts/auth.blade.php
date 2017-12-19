<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <title>AdminLTE 2 | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="stylesheet" href="{{ asset('public/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/bower_components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/DataTables/media/css/dataTables.bootstrap.min.css') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
    @yield('content')
    <script src="{{ asset('public/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('public/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('public/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('public/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/js/validator.min.js')}}"></script>
    @yield('script')
  </body>
</html>