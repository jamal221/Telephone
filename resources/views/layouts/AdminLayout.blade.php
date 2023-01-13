<!DOCTYPE html>

<html lang="en" >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>پنل مدیریت | داشبورد اول</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="dist/css/bootstrap-rtl.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!-- template rtl version -->
    <link rel="stylesheet" href="dist/css/custom-style.css">
    <link  href="css/rippler.min.css" rel="stylesheet">
    <link  rel="stylesheet" href="css/kendo.bootstrap.css">
    <link  rel="stylesheet" href="css/kendo.common.css">
    <link  rel="stylesheet" href="css/kendo.rtl.css">
    <link  rel="stylesheet" href="css/grid.css">
    <link  rel="stylesheet" href="css/w3.css">
    <link  href="css/style2.css" rel="stylesheet">
    <link href="https://cdn1.medu.ir/css/icons-sprite.css" rel="stylesheet">
    <link  href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        table{
            table-layout: fixed;
        }
        td{
            word-wrap:break-word
        }
        #myInput {
            background-image: url('/css/searchicon.png');
            background-position: 10px 10px;
            background-repeat: no-repeat;
            width: 100%;
            font-size: 16px;
            padding: 12px 20px 12px 40px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
        }
    </style>

</head>
<div id="id01" class="w3-modal w3-animate-opacity">
    <div class="w3-modal-content w3-animate-top w3-card-4">
        <header class="w3-container w3-teal">
        <span onclick="document.getElementById('id01').style.display='none'"
              class="w3-button w3-display-topright">&times;</span>
            <h2>Modal Header</h2>
        </header>
        <div class="w3-container">
            <p>Some text..</p>
            <p>Some text..</p>
        </div>
        <footer class="w3-container w3-teal">
            <p>Modal Footer</p>
        </footer>
    </div>
</div>
<body class="hold-transition sidebar-mini" >

<div class="wrapper" >

    <!-- Navbar -->


    <!-- /.navbar -->

    <!-- Main Sidebar Container -->

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-bold size-2" >Admin Pannel </span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar" style="direction: ltr">
            <div style="direction: rtl">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="dist/img/AdminLTELogo.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="/" class="d-block">Desk2929.ir</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link active">


                                <i class="nav-icon fa fa-dashboard"></i>
                                <p>
                                    داشبوردها
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>

                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./ConfirmUser" class="nav-link
                                        @if(app('request')->route()->uri=="ConfirmUser")
                                active
@endif">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>مشاهده ی پرسنل</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./FilterUser" class="nav-link
                                        @if(app('request')->route()->uri=="FilterUser")
                                active
@endif">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>آپلود اطلاعات</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./Deleted_Mobile_users" class="nav-link
                                        @if(app('request')->route()->uri=="Deleted_Mobile_users")
                                active
@endif">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>موبایل حذف شده</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="height: 1000px">
        <!-- Content Header (Page header) -->
        <div class="content-header" id="div_header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">داشبورد</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left" style="margin-right: 10px">
                            <li class="breadcrumb-item icon-close" style="font-size: 15px; color: #7b0861; background-color: #7b0861" ><a href="loglogout">خروج از سایت</a></li>

                        </ol>
                        <ol class="breadcrumb float-sm-left" style="margin-right: 10px">
                            <li class="breadcrumb-item flag-icon-bi" style="font-size: 15px; color: #7b0861; background-color: #7b0861" ><a href="export-users">خروجی اکسل</a></li>

                        </ol>
                        <ol class="breadcrumb float-sm-left">
                            <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">

    {{--                                <li class="breadcrumb-item flag-icon-ad" style="font-size: 15px; color: #7b0861; background-color: #7b0861" >--}}
                                            @csrf
                                            <input type="file" name="file"  id="customFile">
                                            <button class="btn btn-primary">آپلود فایل اکسل</button>

        {{--                                <a href="#" onclick="import_data()">آپلود فایل اکسل</a>--}}
    {{--                                </li>--}}
                            </form>
                        </ol>

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">

            <div class="container-fluid" >
                <!-- Small boxes (Stat box) -->
                <div class="row" id="show_statistic_ribon">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3></h3><!--$Count_msg shows this bracket -->

                                <p>تعداد کاربر</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="/UserStastics" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">

                                <p>موبایل حذف شده</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="/msg_rsponded" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3></h3><!--$count_user shows this bracket -->

                                <p>کاربر فعال</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="/ima" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                        </div>
                    </div>

                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="mx-auto">
                    {{--                        This place is for content --}}
                    @yield('content')
                    @yield('javascript')


                </div>


                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!--<footer class="main-footer">
        <strong>CopyLeft &copy; 2018 <a href="https://github.com/jamal221/desk2929">جمال عزیزبیگی</a>.</strong>
    </footer>-->

    <!-- Control Sidebar -->
    <!--<aside class="control-sidebar control-sidebar-dark">

    </aside>-->
    <!-- /.control-sidebar -->
</div>





</body>
</html>
<script src="plugins/jquery/jquery.min.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src={{asset('js/snow3d.js')}}></script>
<script type="text/javascript" charset="utf-8">
    $.widget.bridge('uibutton', $.ui.button)
    let addSnow = () => {
        const random = (min, max) => Math.random() * (max - min) + min;
        let screenWidth = window.innerWidth;
        let screenHeight = window.innerHeight;
        let snow = document.createElement('div');
        snow.style.position = "fixed";
        snow.style.top = "-2px";
        snow.style.right = random(0, screenWidth) + "px";
        snow.style.width = "10px";
        snow.style.height = "10px";
        snow.style.backgroundColor = "#fff";
        snow.style.borderRadius = "50%";
        snow.style.zIndex = "999";
        snow.style.pointerEvents = "none";
        const animateSnow = () => {
            snow.style.top = parseInt(snow.style.top) + 2 + "px";
            snow.style.right = parseInt(snow.style.right) + random(0, 2) + "px";
            /**
             * If it's out of the screen, move it to the top
             * and randomize it's position
             * */
            if (parseInt(snow.style.top) > screenHeight) {
                snow.style.right = random(0, screenWidth) + "px";
                snow.style.top = parseInt("-" + random(0, 20) + "px");
            }
            window.requestAnimationFrame(animateSnow);
        };
        window.requestAnimationFrame(animateSnow);
        document.body.appendChild(snow);
    };
    function Make_Snow() {

        for (let i = 0; i < 60; i++) {
            setTimeout(addSnow, i * 100);
        }

    }
</script>

