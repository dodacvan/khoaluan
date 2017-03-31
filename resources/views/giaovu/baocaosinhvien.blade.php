@extends('giaovu.master')
@section('controller','Danh sách')
@section('action','Sinh viên')
@section('content')
<a href="{{ URL::route('giaovu.excelsinhvien') }}"><button class="btn btn-success" style="margin-bottom: 10px;">Xuất ra excel</button></a>
<a href="{{ URL::route('giaovu.chart') }}"><button class="btn btn-success" style="margin-bottom: 10px;">Biểu đồ</button></a>
<div class="container">
<form action="" method="get" class="form-inline">
    <div class="form-group" style="float: left">
        <label>Ngành</label>
        <select name="nganh" class="custom-select">
            <option value="">Tất cả</option>
           @foreach ($nganh as $item)
                <option value="{!! $item !!}" {!! ($item == $nganhselect)?"selected":"" !!}>{!! $item !!}</option>
           @endforeach
        </select>  
    </div>
    <div class="type" style="float: left; margin-left: 10px">
        <label>Loại</label>
        <select name="type" class="custom-select">
            <option value="">Tất cả</option>
            <option value="1" {!! ($typeselect == 1)?"selected":"" !!}>Hoàn thành đăng kí</option>
            <option value="2" {!! ($typeselect == 2)?"selected":"" !!}>Đang chỉnh sửa đề tài</option>
            <option value="3" {!! ($typeselect == 3)?"selected":"" !!}>Chưa đăng kí</option>
        </select>
    </div>
    <button type="submit" style="float: left; margin-left: 10px; margin-top: -10px;" class="btn btn-info">Duyet</button>
</form>
<button type="submit" style="float: left; margin-left: 10px; margin-top: -10px;" class="btn btn-warning" data-toggle="modal" data-target="#sendemail">Gửi email</button>
</div>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th style="width: 50px">STT</th>
            <th>Tên</th>
            <th>Lớp</th>
            <th>Email</th>
            <th>Ngành</th>
            <th>Trạng thái</th>
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
                <td>{!! $item['nganh'] !!}</td>
                <?php 
                    switch ($item['show']) {
                        case 'Đã đăng kí thành công':
                            $color = "green";
                            break;
                        case 'Đang hoàn thiện đề tài với giáo viên':
                            $color = "yellow";
                            break;
                        
                        default:
                            $color = "red";
                            break;
                    }
                ?>
                <td style="color: {!! $color !!}">{!! $item['show'] !!}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<div id="sendemail" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Gửi email</h4>
      </div>
      <form id="sendemailform">
      <div class="modal-body">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="_token">
            <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" name="title" class="form-control" />
            </div>
            <div class="form-group">
                <label>Nội dung</label>
                <textarea class="form-control" rows="5" name="contentemail"></textarea>
            </div>
           
           <div id="errorsendemail" style="display:none;" class="alert-danger">Vui lòng nhập đủ các trường</div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="submit" class="btn btn-info">Gửi</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>

  </div>
</div>
@endsection()