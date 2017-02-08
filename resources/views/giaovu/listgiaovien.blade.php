@extends('giaovu.master')
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
            <th>Bộ môn</th>
            <th>Số sinh viên hướng dẫn</th>
        </tr>
    </thead>
    <tbody>
    <?php $stt=0; ?>
                    @foreach($data as $item)
                            <?php
                                switch ($item['hocvi']) {
                                            case 0:
                                                $number = 0;
                                                break;
                                            case 1:
                                                $number = 0;
                                                break;
                                            case 2:
                                                $number = 5;
                                                break;
                                            default:
                                                $number = 7;
                                                break;
                                        }
                            ?>
                            @if($item['sosinhvien']==$number)
                                <tr class="odd gradeX" align="center" style="background:#ea6868">
                            @else
                                <tr class="odd gradeX" align="center" style="background:#84f19a">
                            @endif
                                <td>{!! ++$stt; !!}</td>
                                <td><a href="{!! URL::route('giaovu.infogiaovien', $item['id']) !!}">{!! $item['tengiaovien'] !!}</a></td>
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
                                    <?php
                                        switch ($item['bomon']) {
                                            case 1:
                                               echo  '<td>Công nghệ phần mềm</td>';
                                                break;
                                            case 2:
                                                echo "<td>Hệ thống thông tin</td>";
                                                break;
                                            case 3:
                                                echo "<td>Khoa học máy tính</td>";
                                                break;
                                            case 4:
                                               echo  '<td>Mạng và truyền thông máy tính</td>';
                                                break;
                                            case 5:
                                                echo "<td>Các PP toán trong CN</td>";
                                                break;
                                            case 6:
                                                echo "<td>PTN Công nghệ tri thức</td>";
                                                break;
                                            case 7:
                                               echo  '<td>PTN hệ thống nhúng</td>';
                                                break;
                                            case 8:
                                                echo "<td>PTN Tương tác người máy</td>";
                                                break;
                                            case 9:
                                                echo "<td>Công nghệ nano sinh học</td>";
                                                break;
                                            case 10:
                                               echo  '<td>Vật liệu và linh kiện bán dẫn nano</td>';
                                                break;
                                            case 11:
                                                echo "<td>Vật liệu và linh kiện từ tính nano</td>";
                                                break;
                                            case 12:
                                                echo "<td>Quang tử</td>";
                                                break;
                                            case 13:
                                               echo  '<td>Điện tử và kĩ thuật máy tính</td>';
                                                break;
                                            case 14:
                                                echo "<td>Hệ thống viễn thông</td>";
                                                break;
                                            case 15:
                                                echo "<td>Thông tin vô tuyến</td>";
                                                break;
                                            case 16:
                                               echo  '<td>Vi cơ điện tử và vi hệ thống</td>';
                                                break;
                                            case 17:
                                                echo "<td>PTN Tín hiệu và hệ thống</td>";
                                                break;
                                            case 18:
                                                echo "<td>PTH Điện tử viễn thông</td>";
                                                break;
                                            case 19:
                                               echo  '<td>Cơ điện tử</td>';
                                                break;
                                            case 20:
                                                echo "<td>Công nghệ hàng không vũ trụ</td>";
                                                break;
                                            case 21:
                                                echo "<td>Thủy khí công nghiệp và môi trường</td>";
                                                break;
                                            default:
                                                echo "<td>Công nghệ biển và môi trường</td>";
                                        }

                                    ?>
                                <td>{!! $item['sosinhvien'].'/'.$number !!}</td>
                            </tr>
                        @endforeach
    </tbody>
</table>
@endsection()