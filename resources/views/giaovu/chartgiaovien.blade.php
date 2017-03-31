<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>My Charts</title>
         <link href="{{url('public/admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
        {!! Charts::assets() !!}

    </head>
    <body>
        <center>
            {!! $chart->render() !!}
        </center>
        <a href="{!! URL::previous() !!}" class="btn btn-default">Back</a>
    </body>
</html>