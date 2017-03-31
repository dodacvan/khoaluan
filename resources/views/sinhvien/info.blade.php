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
                    <th>Ngành</th>
                    <td>{!! $data['nganh'] !!}</td>
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
                    <div id="deletedetaisv" style="display:none;" class="alert-success">Yêu cầu thực hiện thành công</div>
                    <div id="errordeletedetaisv" style="display:none;" class="alert-success">Yêu cầu không thực hiện thành công</div>
                </tr>
            </table>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr align="center">
                        <th>Tên</th>
                        <th>Giáo viên</th>
                        <th>Trạng thái</th>
                        <th>Thông báo</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detai as $item)
                        <tr class="odd gradeX" align="center">
                        <td>{!! $item['tendetai']!!}</td>
                        <td>{!! $yeucaugiaovien['tengiaovien'] !!}</td>
                        <?php
                            switch ($item['status']) {
                                case 0:
                                case 2:
                                    echo  "<td style='color:yellow;'>Đang phê duyệt</td>";
                                    $delete = "Xóa";
                                    break;
                                case 4:
                                case 5:
                                case 7:
                                    echo  "<td style='color:yellow;'>Đang phê duyệt</td>";
                                    $delete = "Hủy yêu cầu xóa";
                                    break;  
                                case 1:
                                    echo "<td style='color:green'>Được chấp nhận</td>";
                                    $delete = "Xóa";
                                    break;
                                case 6:
                                    echo "<td style='color:orange'>Yêu cầu sửa lại đề tài</td>";
                                    $delete = "Xóa";
                                    break;
                                default:
                                    $delete = "Xóa";
                                    echo "<td style='color:red'>Không được chấp nhận</td>";
                            }
                        ?>
                        <td>{!! $item['message'] !!}</td>
                        <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#editdetaimodalsv" onclick="nameofdetai('<?= $item['tendetai'] ?>','{!! $item['id'] !!}')">Edit</button></td>
                        <td><button onclick="return xacnhanxoadetai('bạn có muốn xóa','{!! $item['id'] !!}')" class="btn btn-danger">{!! $delete !!}</button></td>
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