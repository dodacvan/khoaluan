@extends('giaovien.master')
@section('controller','Thông tin')
@section('action','Sinh viên')
@section('content')
<div id="container" class="container">
    <div class="row">
    	<div class="col-xs-6">
        <table class="table table-striped">
            <tr>
                <th>Tên sinh viên</th>
                <td>{!! $data['ten'] !!}</td>
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
     <div class="col-xs-6">
        <table class="table table-striped">
            <tr>
                <th>Khoa</th>
                <?php
                    switch ($data['khoa']) {
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
            <tr>
                <th>Ngành</th>
                <td>{!! $data['nganh'] !!}</td>
            </tr>
            <tr>
                <th>Lop</th>
                <td>{!! $data['lop'] !!}</td>
            </tr>
            <tr>
                <th>Giáo viên hướng dẫn</th>
                <td></td>
            </tr>
            <tr>
                <th>Ngày sinh</th>
                <td>{!! $data['ngaysinh'] !!}</td>
            </tr>
        </table>
        
     </div>
     </div>
</div>
@endsection()