@extends('sinhvien.master')
@section('controller','Danh sách')
@section('action','Thông báo')
@section('content')
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th style="width: 50px">STT</th>
            <th>Tiêu đề</th>
            <th>Xem chi tiết</th>
        </tr>
    </thead>
    <tbody>
    <?php $stt=0; ?>
        @foreach($data as $item)
                <tr class="odd gradeX" align="center">
                    <td>{!! ++$stt; !!}</td>
                    <td>{!! $item['title'] !!}</td>
                    <td><a href="{!! URL::route('admin.infopost', ['id'=>$item['id']]) !!}"><button class="btn btn-info">Xem chi tiết</button></a></td>
                </tr>
            @endforeach
    </tbody>
</table>
@endsection()