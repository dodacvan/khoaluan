<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="vandodac">
    <meta name="author" content="vandd">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                
                <a class="navbar-brand" href="">Trang Giáo Viên</a>
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
                            <a href="{!! URL::route('giaovien.info') !!}"><i class="fa fa-info-circle fa-fw"></i> Thông tin cá nhân</a>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="{!! URL::route('giaovien.listyeucau') !!}"><i class="fa fa-envelope fa-fw"></i> Yêu cầu</a>                        
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="{!! URL::route('giaovien.listsinhvien') !!}"><i class="fa fa-list fa-fw"></i> Danh sách sinh viên hướng dẫn</a>                        
                            <!-- /.nav-second-level -->
                        </li>
                       <li>
                            <a href="{!! URL::route('giaovien.changeinfo') !!}"><i class="fa fa-pencil-square-o fa-fw"></i> Chỉnh sửa thông tin cá nhân</a>
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
        function xacnhanxoa(msg, $id){
            if(window.confirm(msg)){
                deletehnc($id);
                return true;
            }
            return false;
        }

        function deletehnc($id){
            $.ajax({
                type: "POST",
                url: '/dangky/admin/giaovien/deletehnc',
                //data: {"txthnc":txthnc, "_token":_token,"giaovien_id":giaovien_id},
                data: {id:$id, _token:'{!! csrf_token() !!}'},
                success: function( response ) {
                    if(response.success == 'true'){
                        $("#deletemessage").show().delay(1000).slideUp();
                        window.setTimeout(function(){location.reload()},3000)
                    }
                    else
                        $("#errorMessage1").show().delay(1000).slideUp();
                },
                error: function (request, status, error) {
                    alert(request.responseText);            
                }
            });  
        }
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
                url: '/dangky/admin/giaovien/deletedetai',
                //data: {"txthnc":txthnc, "_token":_token,"giaovien_id":giaovien_id},
                data: {id:$id, _token:'{!! csrf_token() !!}'},
                success: function( response ) {
                    if(response.success == 'true'){
                        $("#deletedetai").show().delay(1000).slideUp();
                        window.setTimeout(function(){location.reload()},3000)
                    }
                    else
                        $("#errordetai").show().delay(1000).slideUp();
                },
                error: function (request, status, error) {
                    alert(request.responseText);            
                }
            });  
        }
    </script>
    
</body>

</html>

