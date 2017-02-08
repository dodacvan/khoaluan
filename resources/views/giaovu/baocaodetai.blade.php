@extends('giaovu.master')
@section('controller','Danh sách')
@section('action','Đề tài')
@section('content')
<a href="{{ URL::route('giaovu.downdetai','xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th style="width: 50px">STT</th>
            <th>Tên</th>
            <th>Sinh viên</th>
            <th>Giáo viên</th>
			<th>Thời gian</th>
        </tr>
    </thead>
    <tbody>
    <?php $stt=0; ?>
                    @foreach($data as $item)
                            <tr class="odd gradeX" align="center">
                                <td>{!! ++$stt; !!}</td>
                                <td>{!! $item->tendetai !!}</td>
                                <td><a href="{!! URL::route('giaovu.infosinhvien',$item->svid) !!}">{!! $item->ten !!}</a></td>
                                <td><a href="{!! URL::route('giaovu.infogiaovien',$item->id) !!}">{!! $item->tengiaovien !!}</a></td>
                                <td>{!! $item->created_at !!}</td>
                            </tr>
                        @endforeach
    </tbody>
</table>
@endsection()