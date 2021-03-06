@extends('giaovien.master')
@section('controller','Thông tin')
@section('action','Cá nhân')
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
	    </div>
         <div class="col-xs-5">
            <table class="table table-striped">
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
                    <td><button type="button" class="btn btn-success" style="float: right;" data-toggle="modal" data-target="#addnghiencuu">Thêm hướng nghiên cứu</button></td>
                     <div id="successMessage" style="display:none;" class="alert-success">Thêm hướng nghiên cứu thành công</div>
                     <div id="editmessage" style="display:none;" class="alert-success">Sửa hướng nghiên cứu thành công</div>
                    <div id="deletemessage" style="display:none;" class="alert-success">Xóa hướng nghiên cứu thành công</div>
                    <div id="errorMessage1" style="display:none;" class="alert-danger">Lỗi xóa</div>
                </tr>
                 @foreach($hnc as $item)

               <tr>
                    <th style="color: #4CAF50;">{!! $item['ten'] !!}</th>
                    <td style="float: right"><button class="btn btn-info" data-toggle="modal" data-target="#edithnc" onclick="nameofhnc('<?= $item['ten'] ?>','{!! $item['id'] !!}')">
                          <span class="glyphicon glyphicon-edit"></span>
                        </button>
                         <button onclick="return xacnhanxoa('bạn có muốn xóa','{!! $item['id'] !!}')" class="btn btn-danger">
                          <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </td>
                </tr>
                 @endforeach
                <tr>
                    <th>Đề tài đề xuất</th>
                    <td> <button type="button" class="btn btn-success" style="float: right;" data-toggle="modal" data-target="#adddetai">Thêm đề tài</button>
                      
                    </td>
                    
                </tr>
                <tr>
                  <th>
                    <div id="successdetai" style="display:none;" class="alert-success">Thêm đề tài thành công</div>
                    <div id="editdetai" style="display:none;" class="alert-success">Sửa đề tài thành công</div>
                    <div id="deletedetai" style="display:none;" class="alert-success">Xóa đề tài thành công</div>
                    <div id="errordetai" style="display:none;" class="alert-danger">Lỗi xóa</div>
                  </th>
                </tr>
                  @foreach($detai as $item)
                   
               <tr>
                    <th style="color: #4CAF50;">{!! $item['ten'] !!}</th>
                    <td style="float: right"><button class="btn btn-info" data-toggle="modal" data-target="#editdetaimodal" onclick="nameofdetai('<?= $item['ten'] ?>','{!! $item['id'] !!}')">
                          <span class="glyphicon glyphicon-edit"></span>
                        </button>
                         <button onclick="return xacnhanxoadetai('bạn có muốn xóa','{!! $item['id'] !!}')" class="btn btn-danger">
                          <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </td>
                </tr>
                 @endforeach
            </table>
             <a href="{!! URL::previous() !!}" class="btn btn-default">Back</a>   
        </div>
    </div>
   
    <div id="addnghiencuu" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Thêm hướng nghiên cứu</h4>
          </div>
        <form id="addhuongnghiencuu">
          <div class="modal-body">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="_token">
            <input type="hidden" name="giaovien_id" value="{!! $data['id'] !!}">
            <div class="form-group">
                <label>Tên hướng nghiên cứu</label>
                <input class="form-control" name="txthnc" id="txthnc" placeholder="Điền hướng nghiên cứu"/>
            </div>
           
           <div id="errorMessageaddhnc" style="display:none;" class="alert-danger">Vui lòng nhập hướng nghiên cứu</div>
           
          </div>
          <div class="modal-footer">
            <button type="submit" name="submit" class="btn btn-info">Thêm</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
          </div>
        </form>
        </div>

      </div>
    </div>

    <div id="edithnc" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Sửa hướng nghiên cứu</h4>
          </div>
        <form id="edithncform">
          <div class="modal-body">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" >
            <input type="hidden" name="idhnc" id="idhnc">
            <div class="form-group">
                <label>Tên hướng nghiên cứu</label>
                <input class="form-control" name="edittxthnc" id="edittxthnc" placeholder="Điền hướng nghiên cứu"/>
            </div>
           
           <div id="errorMessage2" style="display:none;" class="alert-danger">Vui lòng nhập hướng nghiên cứu</div>
           
          </div>
          <div class="modal-footer">
            <button type="submit" name="submit" class="btn btn-info">Sửa</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
          </div>
        </form>
        </div>

      </div>
    </div>

    <div id="adddetai" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Thêm đề tài</h4>
          </div>
           <form id="adddetaiform">
          <div class="modal-body">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token" >
            <input type="hidden" name="giaovien_id" value="{!! $data['id'] !!}" id="giaovien_id">
            <div class="form-group">
                <label>Tên đề tài</label>
                <input class="form-control" name="txtdetai" id="txtdetai" placeholder="Điền tên đề tài"/>
            </div>
           <div id="errorMessage3" style="display:none;" class="alert-danger">Vui lòng nhập đề tài</div>
           <!-- <div class="form-group">
                <label>Sinh viên thưc hiện</label>
                <select class="form-control" name="sinhvien_id">
                    @foreach($sinhvien as $item)
                        <option value="{!! $item['id'] !!}">{!! $item['ten'] !!}</option>
                    @endforeach
                </select>
            </div> -->
          </div>
          <div class="modal-footer">
            <button type="submit" name="submit" class="btn btn-info">Thêm</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
          </div>
        </form>
        </div>

      </div>
    </div>

    <div id="editdetaimodal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Sửa đề tài</h4>
          </div>
        <form id="editdetaiform">
          <div class="modal-body">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" >
            <input type="hidden" name="iddetai" id="iddetai">
            <div class="form-group">
                <label>Tên đề tài</label>
                <input class="form-control" name="edittxtdetai" id="edittxtdetai"/>
            </div>
           
           <div id="errorMessage4" style="display:none;" class="alert-danger">Vui lòng nhập đề tài</div>
           
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