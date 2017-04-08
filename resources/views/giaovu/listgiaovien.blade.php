@extends('giaovu.master')
@section('controller','Danh sách')
@section('action','Giáo viên')
@section('content')
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th style="width: 50px">STT</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Học vị</th>
            <th>Bộ môn</th>
            <th>Số sinh viên hướng dẫn</th>
        </tr>
    </thead>
    <tbody>
    <?php $stt=0; ?>
                    @foreach($data as $item)
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
                                        if($item['hocham'] == "GS" || $item['hocham'] == "PGS"){
                                            $number = 6;
                                        }
                            ?>
                            @if($item['sosinhvien']==$number)
                                <tr class="odd gradeX" align="center" style="background:#ea6868">
                            @else
                                <tr class="odd gradeX" align="center" style="background:#84f19a">
                            @endif
                                <td>{!! ++$stt; !!}</td>
                                <td><a href="{!! URL::route('giaovu.infogiaovien', $item['id']) !!}">{!! $item['tengiaovien'] !!}</a></td>
                                <td>{!! $item['email'] !!}</td>
                                <td>{!! $item['hocvi'] !!}</td>
                                <td>{!! $item['bomon'] !!}</td>
                                <td>{!! $item['sosinhvien'].'/'.$number !!}</td>
                            </tr>
                        @endforeach
    </tbody>
</table>
@endsection()