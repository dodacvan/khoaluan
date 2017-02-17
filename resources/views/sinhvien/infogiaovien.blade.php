@extends('sinhvien.master')
@section('controller','Thông tin')
@section('action','Giáo viên')
@section('content')
<div id="container" class="container">
    <div class="row">
    	<div class="col-xs-5">
        <table class="table table-striped">
            <tr>
                <th>Tên giáo viên</th>
                <td>{!! $data['tengiaovien'] !!}</td>
            </tr>
            <tr>
                <th>Cell Phone</th>
                <td>{!! $data['sdt'] !!}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{!! $data['email'] !!}</td>
            </tr>
             <tr>
                <th>Giới tính</th>
                @if($data['gioitinh']==1)
                <td>Nam</td>
                @else
                <td>Nữ</td>
                @endif
            </tr>
            <tr>
                <th>Quê quán</th>
                <td>{!! $data['quequan'] !!}</td>
            </tr>
            <tr>
                <th>Địa chỉ</th>
                <td>{!! $data['diachi'] !!}</td>
            </tr>
            <tr>
                <th>Ngày sinh</th>
                <td>{!! date('d-m-Y', strtotime($data['ngaysinh'])) !!}</td>
            </tr>
        </table>
        <a href="{!! URL::previous() !!}" class="btn btn-default">Back</a>   
	 </div>
     <div class="col-xs-5">
        <table class="table table-striped">
            <tr>
                <th>Khoa</th>
                <?php
                    switch ($data['khoa']) {
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
            </tr>
             <tr>
                <th>Bộ môn</th>
                <?php
                    switch ($data['bomon']) {
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
            </tr>
            <tr>
                <th>Chức danh</th>
                <?php
                    switch ($data['chucdanh']) {
                        case 0:
                           echo  '<td></td>';
                            break;
                        case 1:
                            echo "<td>GV</td>";
                            break;
                        case 2:
                            echo "<td>GVC</td>";
                            break;
                        case 3:
                            echo "<td>NVC</td>";
                            break;
                        case 4:
                            echo "<td>GVTH</td>";
                            break;
                        default:
                            echo "<td>GVCC</td>";
                    }
                ?>
            </tr>
            <tr>
                <th>Học hàm</th>
                <?php
                    switch ($data['hocham']) {
                        case 0:
                           echo  '<td></td>';
                            break;
                        case 1:
                            echo "<td>Phó giáo sư</td>";
                            break;
                        default:
                            echo "<td>Giáo sư</td>";
                    }
                ?>
            </tr>
            <tr>
                <th>Học vị</th>
                <?php
                    switch ($data['hocham']) {
                        case 0:
                           echo  '<td></td>';
                            break;
                        case 1:
                            echo "<td>Cử nhân</td>";
                            break;
                        case 2:
                            echo "<td>Thạc sĩ</td>";
                            break;
                        default:
                            echo "<td>Tiến sĩ</td>";
                    }
                ?>
            </tr>
             <tr>
                <th>Số sinh viên nhận hướng dẫn</th>
                <td>{!! $data['sosinhvien'] !!}</td>
            </tr>
           
        </table>
        
     </div>
     </div>
</div>
@endsection()