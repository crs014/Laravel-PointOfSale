<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Grandeur</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('public/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/bower_components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/DataTables/media/css/dataTables.bootstrap.min.css') }}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- open navbar -->
        <header class="main-header">
            <a href="index2.html" class="logo">
                <span class="logo-mini"><b>G</b>RD</span>
                <span class="logo-lg"><b>Grandeur</b></span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <ul class="menu">
                                        <!-- loop here -->
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into thepage and may cause design problems
                                            </a>
                                        </li>
                                        <!-- end loop -->
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                        <!-- Tasks: style can be found in dropdown.less -->
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-flag-o"></i>
                                <span class="label label-danger">9</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <ul class="menu">
                                        <!-- loop here -->
                                        <li>
                                            <a href="#">
                                                <h3>Design some buttons<small class="pull-right">20%</small></h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all tasks</a></li>
                            </ul>
                        </li>
                        @if (Auth::guest())
                            &nbsp;
                        @else
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="hidden-xs">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <p>
                                        {{ Auth::user()->name }}
                                        <small>Member since Nov. 2012</small>
                                    </p>
                                </li>
                                <li class="user-body">
                                    <div class="row">
                                        <div class="col-xs-4 text-center"><a href="#">Followers</a></div>
                                        <div class="col-xs-4 text-center"><a href="#">Sales</a></div>
                                        <div class="col-xs-4 text-center"><a href="#">Friends</a></div>
                                    </div>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <section class="sidebar">
                <ul class="sidebar-menu" data-widget="tree">
                    @if (Auth::guest())
                        &nbsp;
                    @else
                        <li class="header">MAIN NAVIGATION</li>
                        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                        <li><a href="{{ route('categories.index') }}"><i class="fa fa-cubes"></i> <span>Kategori</span></a></li>
                        <li><a href="{{ route('products.index') }}"><i class="fa fa-cube"></i> <span>Produk</span></a></li>
                        <li><a href="{{ route('purchases.index') }}"><i class="fa fa-upload"></i> <span>Pembelian</span></a></li>
                        <li><a href="{{ route('sales.index') }}"><i class="fa fa-download"></i> <span>Penjualan</span></a></li>
                        <li><a href="{{ route('payment.index') }}"><i class="fa fa-credit-card"></i> <span>History Pembayaran</span></a></li>
                        <li><a href="#"><i class="fa fa-book"></i> <span>Laporan</span></a></li>
                    @endif
                </ul>
            </section>
        </aside>
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>
    <!-- close navbar-->
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
