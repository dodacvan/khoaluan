@extends('sinhvien.master')
@section('controller','Danh sách')
@section('action','Giáo viên')
@section('content')
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th style="width: 50px">STT</th>
            <th>Tên</th>
            <th>Điện thoại</th>
            <th>Email</th>
            <th>Bộ môn</th>
            <th>Số sinh viên đã nhận</th>
            <th>Hẹn gặp</th>
            <th>Đăng kí</th>
        </tr>
    </thead>
    <tbody>
    <?php $stt=0; ?>
                    @foreach($newdata as $item)
                        <?php
                            switch ($item['hocvi']) {
                                case "":
                                    $number = 0;
                                    break;
                                case "CN":
                                    $number = 0;
                                    break;
                                case "Ths":
                                    $number = 3;
                                    break;
                                default:
                                    $number = 5;
                                    break;
                            }
                        ?>
                        @if($item['show'])
                            <tr class="odd gradeX" align="center" style="background:#84f19a">
                        @else
                            <tr class="odd gradeX" align="center" style="background:#ea6868">
                        @endif
                                <td>{!! ++$stt; !!}</td>
                                <td><a href="{!! URL::route('sinhvien.infogiaovien', $item['id']) !!}">{!! $item['tengiaovien'] !!}</a></td>
                                <td>{!! $item['sdt'] !!}</td>
                                <td>{!! $item['email'] !!}</td>
                                <td>{!! $item['bomon'] !!}</td> 
                                <td class="center">{!! $item['sosinhvien'].'/'.$number !!}</td>
                                <td><a href="{!! URL::route('sinhvien.addlichhen',$item['id']) !!}"><button class="btn btn-info">Hẹn gặp</button></a></td>
                                <td class="center"><button type="button" class="btn btn-info btn-sm" <?php if(!$item['show']) echo "disabled style='background:#ea6868'"; ?>><i class="glyphicon glyphicon-star fa-fw"><a href="{!! URL::route('sinhvien.adddetai', $item['id']) !!}"></i>Đăng kí</a></button></td>
                            </tr>
                        @endforeach
    </tbody>
</table>
@endsection()