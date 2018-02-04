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
    @if(Auth::user()->role != 1)
    <link rel="stylesheet" href="{{ asset('public/calender/style.css') }}">
    <style type="text/css">
    @font-face {
        font-family: digital-clock;
        src: url(/public/fonts/digital-7.ttf);
    }
    </style>
    <script type="text/javascript" src="{{ asset('public/calender/script.js') }}" ></script>
    @endif
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- open navbar -->
        <header class="main-header">
            <a href="{{ route('home') }}" class="logo">
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
                                <span class="label label-warning" id="count-notif-product"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header" id="header-notif-product"></li>
                                <li>
                                    <ul class="menu" id="menu-notif-product">
                                        <!-- loop here -->
                                        
                                        <!-- end loop -->
                                    </ul>
                                </li>
                                <li class="footer"><a href="{{ route('products.index') }}">Lihat Semua Produk</a></li>
                            </ul>
                        </li>
                        <!-- Tasks: style can be found in dropdown.less -->
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-flag-o"></i>
                                <span class="label label-danger" id="count-notif-sale"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header" id="header-notif-sale"></li>
                                <li>
                                    <ul class="menu" id="menu-notif-sale">
                                        <!-- loop here -->
                                       
                                        <!-- end loop -->
                                    </ul>
                                </li>
                                <li class="footer"><a href="{{ route('sales.index') }}">Liat Semua Penjualan</a></li>
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
                                    </p>
                                </li>
                                <li class="user-body">
                                    <div class="row">
                                    </div>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ route('profile.index') }}" class="btn btn-default btn-flat">Profile</a>
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
                        @if(Auth::user()->role == 1)
                            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                            <li><a href="{{ route('categories.index') }}"><i class="fa fa-cubes"></i> <span>Kategori</span></a></li>
                            <li><a href="{{ route('products.index') }}"><i class="fa fa-cube"></i> <span>Produk</span></a></li>
                            <li><a href="{{ route('purchases.index') }}"><i class="fa fa-upload"></i> <span>Pembelian</span></a></li>
                            <li><a href="{{ route('sales.index') }}"><i class="fa fa-download"></i> <span>Penjualan</span></a></li>
                            <li><a href="{{ route('payment.index') }}"><i class="fa fa-credit-card"></i> <span>History Pembayaran</span></a></li>
                            <li><a href="{{ route('report.index') }}"><i class="fa fa-book"></i> <span>Laporan</span></a></li>
                            <li><a href="{{ route('employee.index') }}"><i class="fa fa-user"></i> <span>Karyawan</span></a></li>
                        @else
                            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                            <li><a href="{{ route('products.index') }}"><i class="fa fa-cube"></i> <span>Produk</span></a></li>
                            <li><a href="{{ route('sales.index') }}"><i class="fa fa-download"></i> <span>Penjualan</span></a></li>
                        @endif
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
    <script src="{{ asset('public/js/chart.js')}}"></script>
    <script type="text/javascript">
        function toRp(angka){
            var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
            var rev2    = '';
            for(var i = 0; i < rev.length; i++){
                rev2  += rev[i];
                if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
                    rev2 += '.';
                }
            }
            return 'Rp. ' + rev2.split('').reverse().join('');
        }   

        $(function(){

            //=======load product_notification data=======
            $.ajax({
                url : "{{ route('json.product_notification') }}",
                type : "POST",
                data : { '_method' : 'POST', '_token' : $('input[name=_token]').val() },
                success : function(data) {
                    data = JSON.parse(data);
                    var count = data.length;
                    var text = "";
                    for(x in data) {
                        if(x == 4){
                            break;
                        }
                        if(data[x].stock < 0){
                            text +=  "<li>"+
                                    "<a href='#''>"+
                                    "<i class='fa fa-warning text-yellow'></i>" + 
                                    "kode barang " + data[x].code_product + " kurang" +
                                    "</a>"+
                                    "</li>";                            
                        }
                        else{
                            text +=  "<li>"+
                                    "<a href='#''>"+
                                    "<i class='fa fa-warning text-yellow'></i>" + 
                                    "kode barang " + data[x].code_product + " habis" +
                                    "</a>"+
                                    "</li>";
                        }

                    }
                    $("#count-notif-product").text(count);
                    $("#header-notif-product").text("produk yang habis atau kurang ada " + count);
                    $("#menu-notif-product").append(text);
                },
                error : function() {
                    alert("gagal ambil data notifikasi");
                }
            });


            //=======load sale_notification data=======
           $.ajax({
                url : "{{ route('json.sale_notification') }}",
                type : "POST",
                data : { '_method' : 'POST', '_token' : $('input[name=_token]').val() },
                success : function(data) {
                    data = JSON.parse(data);
                    var count = data.length;
                    var text = "";
                    for(x in data) {
                        if(x == 4){
                            break;
                        }
                        text +=  "<li>"+
                                    "<a href='/sales/"+data[x].id+"'>"+
                                    "<i class='fa fa-warning text-yellow'></i> " + 
                                    "Nomor Nota " + data[x].number  +
                                    "</a>"+
                                    "</li>";
                    }
                    $("#count-notif-sale").text(count);
                    $("#header-notif-sale").text("penjualan yang seminggu belum lunas ada " + count);
                    $("#menu-notif-sale").append(text);
                },
                error : function() {
                    alert("gagal ambil data notifikasi");
                }
            });      
        }); 

    </script>
    @yield('script')
</body>
</html>
