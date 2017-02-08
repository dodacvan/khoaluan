@extends('giaovien.master')
@section('controller','Yêu cầu')
@section('action','Chờ phê duyệt')
@section('content')
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th style="width: 50px">STT</th>
            <th>Tên</th>
            <th>Sinh viên</th>
            <th>Email</th>
			<th>Phê duyệt</th>
            <th>Không phê duyệt</th>
        </tr>
    </thead>
     <tbody>
    <?php $stt=0; ?>
        @foreach($data as $item)
        <br>
            <tr class="odd gradeX" align="center">
                <td id="{!! ++$stt; !!}">{!! $stt !!}</td>
                <td>{!! $item->tendetai !!}</td>
                <td><a href="{!! URL::route('giaovien.infosinhvien',$item->id) !!}">{!! $item->ten !!}</a></td>
                <td>{!! $item->email !!}</td>
                <td><button type="button" class="btn btn-success access" data-value='{"action":"access","value":{!! $item->yeucauid !!}}' data-token="{{ csrf_token() }}">Phê duyệt</button></td>
                <td><button type="button" class="btn btn-danger access" data-value='{"action":"deny","value":{!! $item->yeucauid !!}}'  data-token="{{ csrf_token() }}">Không phê duyệt</button></td>
            </tr>
        @endforeach
    </tbody>
   
</table>
@endsection()