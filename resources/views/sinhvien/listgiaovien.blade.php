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
            <th>Khoa</th>
            <th>Số sinh viên đã nhận</th>
            <th>Đăng kí</th>
        </tr>
    </thead>
    <tbody>
    <?php $stt=0; ?>
                    @foreach($data as $item)
                            <tr class="odd gradeX" align="center">
                                <td>{!! ++$stt; !!}</td>
                                <td><a href="{!! URL::route('sinhven.infogiaovien', $item['id']) !!}">{!! $item['tengiaovien'] !!}</a></td>
                                <td>{!! $item['sdt'] !!}</td>
                                <td>{!! $item['email'] !!}</td>
                                   <?php
                                        switch ($item['khoa']) {
                                            case 0:
                                               echo  '<td>CNTT</td>';
                                                break;
                                            case 1:
                                                echo "<td>Vật lý kĩ thuật và công nghệ nano</td>";
                                                break;
                                            case 2:
                                                echo "<td>Điện tử viễn thông</td>";
                                                break;
                                            default:
                                                echo "<td>Cơ học kĩ thuật và tự động hóa</td>";
                                        }
                                    ?>
                             <td class="center">{!! $item['sosinhvien'] !!}</td>
                                <td class="center"><a href="{!! URL::route('sinhvien.adddetai', $item['id']) !!}"><button type="button" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-star fa-fw"></i>Đăng kí</button></a></td>
                            </tr>
                        @endforeach
    </tbody>
</table>
@endsection()