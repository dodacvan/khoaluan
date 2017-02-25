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
            <th>Khoa</th>
        </tr>
    </thead>
    <tbody>
    <?php $stt=0; ?>
        @foreach($data as $item)
                <tr class="odd gradeX" align="center">
                    <td>{!! ++$stt; !!}</td>
                    <td><a href="{!! URL::route('giaovien.infosinhvien', $item->svid) !!}">{!! $item->ten !!}</a></td>
                    <td>{!! $item->tendetai !!}</td>
                    <td>{!! $item->lop !!}</td>
                    <td>{!! $item->email !!}</td>
                    <?php
                        switch ($item->khoa) {
                            case 0:
                               echo  '<td>CNTT</td>';
                                break;
                            case 1:
                                echo "<td>Vật lý kĩ thuật</td>";
                                break;
                            case 2:
                                echo "<td>Cơ kĩ thuật</td>";
                                break;
                            default:
                                echo "<td>Truyền thông và mạng máy tính</td>";
                        }
                    ?>
                </tr>
            @endforeach
    </tbody>
</table>
@endsection()