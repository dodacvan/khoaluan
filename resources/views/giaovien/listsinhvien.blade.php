@extends('giaovien.master')
@section('controller','Danh sách')
@section('action','Sinh viên')
@section('content')
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th style="width: 50px">STT</th>
            <th>Tên</th>
            <th>Đề tài</th>
            <th>Lớp</th>
            <th>Email</th>
            <th>Ngành</th>
            <th>Hẹn gặp</th>
        </tr>
    </thead>
    <tbody>
    <?php $stt=0; ?>
        @foreach($data as $item)
                <tr class="odd gradeX" align="center">
                    <td>{!! ++$stt; !!}</td>
                    <td><a href="{!! URL::route('giaovien.infosinhvien', $item->svid) !!}">{!! $item->ten !!}</a></td>
                    <?php
                        switch ($item->status) {
                            case 2:
                            case 5:
                               echo  "<td style='color: yellow'>$item->tendetai</td>";
                                break;
                            default:
                                echo "<td style='color: green'>$item->tendetai</td>";
                        }
                    ?>
                    <td>{!! $item->lop !!}</td>
                    <td>{!! $item->email !!}</td>
                    <td>{!! $item->nganh !!}</td>
                    <td><a href="{!! URL::route('giaovien.addlichhen',$item->svid) !!}"><button class="btn btn-info">Hẹn gặp</button></a></td>
                </tr>
            @endforeach
    </tbody>
</table>
@endsection()