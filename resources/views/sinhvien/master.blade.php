`<!DOCTYPE html>
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
                
                <a class="navbar-brand" href="">Trang Sinh Viên</a>
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
                            <a href="{!! URL::route('sinhvien.info',Auth::user()->id) !!}"><i class="fa fa-info-circle fa-fw"></i> Thông tin cá nhân</a>
                            
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="{!! URL::route('sinhvien.listgiaovien') !!}"><i class="fa fa-list fa-fw"></i> Danh sách giáo viên</a>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="{!! URL::route('sinhvien.listhnc') !!}"><i class="fa fa-graduation-cap fa-fw"></i> Hướng nghiên cứu</br> tham khảo</a>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="{!! URL::route('sinhvien.listdetai') !!}"><i class="fa fa-book fa-fw"></i> Đề tài tham khảo</a>
                            <!-- /.nav-second-level -->
                        </li>
                       <li>
                            <a href="{!! URL::route('sinhvien.changeinfo') !!}"><i class="fa fa-pencil-square-o fa-fw"></i> Thay đổi thông tin cá nhân</a>
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
                        <div class="alert alert-{!! Session::get('status') !!}">
                            {!! Session::get('flash_message') !!}
                        </div>
                    @endif
                    <div id="errorMessage" style="display:none;" class=" alert alert-danger"></div>
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
	<script src="{{url('public/admin/dist/js/myscript.js')}}"></script>
    <script type="text/javascript">
        function xacnhanxoadetai(msg, $id){
            if(window.confirm(msg)){
                deletedetai($id);
                return true;
            }
            return false;
        }

        function deletedetai($id){
            $.ajax({
                type: "POST",
                url: '/dangky/admin/sinhvien/deletedetai',
                //data: {"txthnc":txthnc, "_token":_token,"giaovien_id":giaovien_id},
                data: {id:$id, _token:'{!! csrf_token() !!}'},
                success: function( response ) {
                    if(response.success == 'true'){
                        $("#deletedetaisv").show().delay(1000).slideUp();
                        window.setTimeout(function(){location.reload()},3000)
                    }
                    else
                        $("#errordeletedetaisv").show().delay(1000).slideUp();
                },
                error: function (request, status, error) {
                    alert(request.responseText);            
                }
            });  
        }
    </script>
    
</body>

</html>

