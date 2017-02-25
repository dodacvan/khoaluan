@extends('sinhvien.master')
@section('controller','Thông tin')
@section('action','Cá nhân')
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
                
            </table>
        
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
                    <th>Ngành</th>
                     <?php
                        switch ($data['nganh']) {
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
                </tr>
                <tr>
                    <th>Lop</th>
                    <td>{!! $data['lop'] !!}</td>
                </tr>
                <tr>
                    <th>Ngày sinh</th>
                    <td>{!! date('d-m-Y', strtotime($data['ngaysinh'])) !!}</td>
                </tr>
                 <tr>
                    <th>Giáo viên hướng dẫn</th>
                    <td><a href="{!!URL::route('sinhven.infogiaovien',$giaovien['id'])!!}">{!! $giaovien['tengiaovien'] !!}</a></td>
                </tr>
            </table>        
         </div>
        <div class="col-xs-10">
            <table class="table table-striped">
                <tr>
                    <th>Đề tài</th>
                    <td></td>
                    <div id="messagerequest" style="display:none;" class="alert-success">Yêu cầu được gửi tới giáo viên chờ phê duyệt</div>
                    <div id="deletedetaisv" style="display:none;" class="alert-success">Yêu cầu xóa thành công</div>
                    <div id="errordeletedetaisv" style="display:none;" class="alert-success">Yêu cầu xóa không thành công</div>
                </tr>
            </table>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr align="center">
                        <th>Tên</th>
                        <th>Trạng thái</th>
                        <th>Thông báo</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach($detai as $item)
                         <tr class="odd gradeX" align="center">
                         <td>{!! $item['tendetai']!!}</td>
                         <?php
                            switch ($item['status']) {
                                case 0:
                                case 2:
                                case 4:
                                case 5:
                                   echo  "<td style='color:yellow;'>Đang phê duyệt</td>";
                                    break;
                                case 1:
                                    echo "<td style='color:green'>Được chấp nhận</td>";
                                    break;
                                default:
                                    echo "<td style='color:red'>Không được chấp nhận</td>";
                            }
                            ?>
                        <td>{!! $item['message'] !!}</td>
                         <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#editdetaimodalsv" onclick="nameofdetai('<?= $item['tendetai'] ?>','{!! $item['id'] !!}')">Edit</button></td>
                         <td><button onclick="return xacnhanxoadetai('bạn có muốn xóa','{!! $item['id'] !!}')" class="btn btn-danger">Xóa</button></td>
                         @endforeach
                </tbody>
            </table>
            <a href="{!! URL::previous() !!}" class="btn btn-default">Back</a> 
        </div>
        </div>
            <div id="editdetaimodalsv" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sửa đề tài</h4>
                  </div>
                <form id="editdetaisv">
                  <div class="modal-body">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}" >
                    <input type="hidden" name="iddetai" id="iddetai">
                    <div class="form-group">
                        <label>Tên đề tài</label>
                        <input class="form-control" name="edittxtdetai" id="edittxtdetai"/>
                    </div>
                   
                   <div id="errorMessagesv" style="display:none;" class="alert-danger">Vui lòng nhập đề tài</div>
                   <div id="errorMessagesvnotfound" style="display:none;" class="alert-danger">Không tìm thấy dữ liệu</div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-info">Sửa</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                  </div>
                </form>
                </div>

            </div>
        </div>
</div>
@endsection()