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
                <td>{!! $data['ngaysinh'] !!}</td>
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
                <td>{!! $data['bomon'] !!}</td>
            </tr>
            <tr>
                <th>Chức danh</th>
                <td>{!! $data['chucdanh'] !!}</td>
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