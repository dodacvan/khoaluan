@extends('sinhvien.master')
@section('controller','Danh sách')
@section('action','Lịch hẹn')
@section('content')
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th style="width: 50px">STT</th>
            <th>Tên giáo viên</th>
            <th>Tiêu để</th>
            <th>Thời gian</th>
            <th>Địa điểm</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
    </thead>
    <tbody>
    <?php $stt=0; ?>
        @foreach($data as $item)
                <tr class="odd gradeX" align="center">
                    <td>{!! ++$stt; !!}</td>
                    <td><a href="{!! URL::route('sinhvien.infogiaovien', $item->gvid) !!}">{!! $item->tengiaovien !!}</a></td>
                    <td>{!! $item->tieude !!}</td>
                     <td>{!! date('d-m-Y H:i:s', strtotime($item->thoigian)) !!}</td>
                    <td>{!! $item->diadiem !!}</td>
                    <td><a href="{!! URL::route('sinhvien.geteditlichhen',$item->id ) !!}"><button class="btn btn-info">Sửa</button></a></td>
                    <td><a onclick="return xacnhanxoa('are you sure delete this')" href="{!! URL::route('sinhvien.deletelichhen',$item->id) !!}"><button class="btn btn-danger">Xóa</button></a></td>
                </tr>
            @endforeach
    </tbody>
</table>
@endsection()