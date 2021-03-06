<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="vandodac">
    <meta name="author" content="vandd">
    <title>Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{url('public/admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{url('public/admin/bower_components/metisMenu/dist/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{url('public/admin/dist/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{url('public/admin/bower_components/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="{{url('public/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{url('public/admin/bower_components/datatables-responsive/css/dataTables.responsive.css')}}" rel="stylesheet">

    
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                
                <a class="navbar-brand" href="">Trang Giáo Vụ</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
               
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                      
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ url('/auth/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>  
                </li>
               
            </ul>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="#"><i class="fa fa-group fa-fw"></i> Giáo viên<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! URL::route('giaovu.listgiaovien') !!}">Danh sách giáo viên</a>
                                </li>
                                <li>
                                    <a href="{!! URL::route('giaovu.addgiaovien') !!}">Thêm giáo viên</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-graduation-cap fa-fw"></i> Sinh viên<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! URL::route('giaovu.listsinhvien') !!}">Danh sách sinh viên</a>
                                </li>
                                <li>
                                    <a href="{!! URL::route('giaovu.addsinhvien') !!}">Thêm sinh viên</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-star"></i> Thông báo<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! URL::route('admin.listpost') !!}">Tất cả thông báo</a>
                                </li>
                                <li>
                                    <a href="{!! URL::route('giaovu.getaddpost') !!}">Thêm thông báo</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                       <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Xuất báo cáo<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! URL::route('giaovu.xuatbaocaodetai') !!}">Thống kê đề tài</a>
                                </li>
                                <li>
                                    <a href="{!! URL::route('giaovu.baocaogiaovien') !!}">Thống kê giáo viên</a>
                                </li>
                                <li>
                                    <a href="{!! URL::route('giaovu.baocaosinhvien') !!}">Thống kê sinh viên</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="{!! URL::route('giaovu.settime') !!}"><i class="glyphicon glyphicon-time"></i>  Cài đặt thời gian</br>   đăng kí</a>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="{!! URL::route('giaovu.crawlerdata') !!}"><i class="fa fa-download"></i>  Cập nhập thông tin</br> nghiên cứu của giáo viên</a>
                            <!-- /.nav-second-level -->
                        </li>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">@yield('controller')
                            <small>@yield('action')</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
				<div class="col-lg-12">
                    @if (Session::has('flash_message'))
                        <div class="alert alert-success">
                            {!! Session::get('flash_message') !!}
                        </div>
                    @endif
                </div>


				@yield('content')
                    
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{url('public/admin/bower_components/jquery/dist/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{url('public/admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{url('public/admin/bower_components/metisMenu/dist/metisMenu.min.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{url('public/admin/dist/js/sb-admin-2.js')}}"></script>

    <!-- DataTables JavaScript -->
    <script src="{{url('public/admin/bower_components/DataTables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('public/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js')}}"></script>
	<!-- myscript -->
	<script src="{{url('public/admin/dist/js/myscript.js')}}" type="text/javascript"></script>

    <script type="text/javascript">
    $("#changetime").submit(function(e){
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "{{ URL::route('giaovu.postsettime') }}",
            data: $("#changetime").serialize(),
            dataType: "json",
            success: function(response){
                if(response.success == 'true'){
                    window.location.reload();
                } else {
                    $("#errorsettime").show();
                }
            }
        });
    });

    $("#sendemailform").submit(function(e){
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "{{ URL::route('giaovu.sendemailsv') }}",
            data: $("#sendemailform").serialize(),
            dataType: "json",
            success: function(response){
                if(response.success == 'true'){
                    alert("gửi email thành công");
                } else {
                    $("#errorsendemail").show();
                }
            }
        });
    });
        // $('#gvdepart').change(function(){
        //     $.get("", { option: $(this).val() }, 
        //     function(data) {
        //         var model = $('#gvclass');
        //         model.empty();
        //         $.each(data, function(index, element) {
        //             model.append("<option value='"+ element.value +"'>" + element.name + "</option>");
        //         });
        //     });
        // });

        // $('#svdepart').change(function(){
        //     $.get("", { option: $(this).val() }, 
        //     function(data) {
        //         var model = $('#svacademic');
        //         model.empty();
        //         $.each(data, function(index, element) {
        //             model.append("<option value='"+ element.value +"'>" + element.name + "</option>");
        //         });
        //     });
        // });
    </script>

</body>

</html>

