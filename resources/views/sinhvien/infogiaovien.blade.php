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
                
            </table>   
	    </div>
        <div class="col-xs-5">
            <table class="table table-striped">
                <tr>
                    <th>Ngày sinh</th>
                    <td>{!! date('d-m-Y', strtotime($data['ngaysinh'])) !!}</td>
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
                            case "":
                               echo  '<td></td>';
                                break;
                            case "PGS":
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
                        switch ($data['hocvi']) {
                            case "":
                               echo  '<td></td>';
                                break;
                            case "CN":
                                echo "<td>Cử nhân</td>";
                                break;
                            case "Ths":
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
        <div class="col-xs-10">
            <table class="table table-striped">
                <tr>
                    <th>Hướng nghiên cứu</th>
                </tr>
                @foreach($hnc as $item)
                    <tr>
                        <th style="color: #4CAF50;">{!! $item['ten'] !!}</th>     
                    </tr>
                @endforeach
                <tr>
                    <th>Đề tài đề xuất</th>
                </tr>
                @foreach($detai as $item)
                    <tr>
                        <th style="color: #4CAF50;">{!! $item['ten'] !!}</th>     
                    </tr>
                @endforeach
            </table>
            <a href="{!! URL::previous() !!}" class="btn btn-default">Back</a>
        </div>
    </div>
</div>
@endsection()