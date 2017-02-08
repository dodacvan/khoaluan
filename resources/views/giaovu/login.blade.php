<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="dacvankc">
    <meta name="author" content="Vu Quoc Tuan">

    <title>Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{url('public/admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{url('public/admin/bower_components/metisMenu/dist/metisMenu.min.css')}}" rel="stylesheet">

     <!-- Custom CSS -->
    <link href="{{url('public/admin/dist/css/sb-admin-2.css')}}" rel="stylesheet">

     <!-- Custom Fonts -->
    <link href="{{url('public/admin/bower_components/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Log In</h3>
                    </div>
                    <div class="panel-body">
                    @if (Session::has('flash_message'))
                        <div class="alert alert-danger">
                            {!! Session::get('flash_message') !!}
                        </div>
                    @endif

                        <form role="form" action="" method="POST">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                            <fieldset>
                                <div class="form-group">
                                    <label>username</label>
                                    <input class="form-control" placeholder="Username" name="username" type="text" >
                                </div>
                        @if($errors->first('username'))
                                    <div class="alert alert-danger">
                        {!! $errors->first('username') !!}
                            </div>
                       @endif

                                <div class="form-group">
                                <label>password</label>
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                        @if($errors->first('password'))
                                    <div class="alert alert-danger">
                        {!! $errors->first('password') !!}
                            </div>
                        @endif

                                <button type="submit" class="btn btn-lg btn-primary btn-block">Login</button>
                            </fieldset>
                        </form>
                
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{url('public/admin/bower_components/jquery/dist/jquery.min.js')}}"></script>

     <!-- Bootstrap Core JavaScript -->
    <script src="{{url('public/admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{url('public/admin/bower_components/metisMenu/dist/metisMenu.min.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{url('public/admin/dist/js/sb-admin-2.js')}}"></script>


    <script src="{{url('public/admin/dist/js/myscript.js')}}"></script>

</body>

</html>
