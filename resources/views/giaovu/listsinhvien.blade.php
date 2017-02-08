@extends('giaovu.master')
@section('controller','Danh sách')
@section('action','Sinh viên')
@section('content')
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th style="width: 50px">STT</th>
            <th>Tên</th>
            <th>Lớp</th>
            <th>Email</th>
			<th>Khoa</th>
            <th>Ngành</th>
            <th>Trạng thái</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php $stt=0; ?>
                    @foreach($data as $item)
                            <tr class="odd gradeX" align="center">
                                <td>{!! ++$stt; !!}</td>
                                <td><a href="{!! URL::route('giaovu.infosinhvien', $item['id']) !!}">{!! $item['ten'] !!}</a></td>
                                <td>{!! $item['lop'] !!}</td>
                                <td>{!! $item['email'] !!}</td>
                                <?php
                                    switch ($item['khoa']) {
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
                                    switch ($item['nganh']) {
                                        case 0:
                                           echo '<td>CNTT</td>';
                                            break;
                                        case 1:
                                            echo "<td>Khoa học máy tính</td>";
                                            break;
                                        case 2:
                                            echo "<td>Hệ thống thông tin</td>";
                                            break;
                                        case 3:
                                           echo '<td>Truyền thông và mạng máy tính</td>';
                                            break;
                                        case 4:
                                            echo "<td>Vật lý kỹ thuật</td>";
                                            break;
                                        case 5:
                                            echo "<td>Kỹ thuật năng lượng</td>";
                                        case 6:
                                           echo '<td>Công nghệ kỹ thuật điện tử viễn thông</td>';
                                            break;
                                        case 7:
                                            echo "<td>Cơ kỹ thuật</td>";
                                            break;
                                        default:
                                            echo "<td>Công nghệ kỹ thuật cơ điện tử</td>";
                                    }
                                ?>
                            @if($item['magiaovien']==0)
                                <td style="color: yellow">Chưa đăng kí</td>
                            @else
                                <td style="color: green">Đã đăng kí</td>
                            @endif
                             <td class="center"><i class="fa fa-trash-o  fa-fw"></i> Delete</td>
                            </tr>
                        @endforeach
    </tbody>
</table>
@endsection()