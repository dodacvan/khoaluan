@extends('giaovu.master')
@section('controller','')
@section('action','Thời gian')
@section('content')
<div id="container" class="container">
	@if($thoigian)
    <div class="row">
    	<div class="col-xs-5">
	        <table class="table table-striped">
	            <tr>
	                <th>Thời gian bắt đầu</th>
	                <td>{!! date('d-m-Y H:i:s', strtotime($thoigian['thoigianbatdau'])) !!}</td>
	            </tr>
	            <tr>
	                <th>Thời gian kết thúc</th>
	                <td>{!! date('d-m-Y H:i:s', strtotime($thoigian['thoigianketthuc'])) !!}</td>
	            </tr>
	            <tr>
	                <th>Thời gian còn lại</th>
	                <td id="resulttime"></td>
	            </tr>
	        </table>
	        <button class="btn btn-default" data-toggle="modal" data-target="#settime">Thay đổi thời gian</button>
	        <a href="{!! URL::previous() !!}" class="btn btn-default">Quay lại</a>   
	   </div>
	</div>
	@endif
	<div id="settime" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Thay đổi thời gian</h4>
	      </div>
	      <form method="post" id="changetime">
		      <div class="modal-body">
		        <input type="hidden" name="_token" value="{!! csrf_token() !!}" >
	            <div class="form-group">
	                <label>Thời gian bắt đầu</label>
	                <input type="datetime-local" class="form-control" name="timestart" id="timestart"/>
	            </div>
           		<div class="form-group">
	                <label>Thời gian kết thúc</label>
	                <input type="datetime-local" class="form-control" name="timeend" id="timeend"/>
	            </div>
           		<div id="errorsettime" style="display:none;" class="alert-danger">co loi vui long nhap dung</div>
		      </div>
		      <div class="modal-footer">
		      	<button type="submit" class="btn btn-default">Submit</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		   </form>
	    </div>

	  </div>
	</div>
</div>
<script type="text/javascript">
var date_start = new Date("<?php echo $thoigian['thoigianbatdau']; ?>");
var date_end = new Date("<?php echo $thoigian['thoigianketthuc']; ?>");
setInterval(function(){
	var current_date = new Date();
	diff  =  Math.floor((date_end - current_date)/1000);
    days  = Math.floor(diff/86400);
    hours = Math.floor((diff-days*86400)/3600);
    mimutes = Math.floor((diff-days*86400-hours*3600)/60);
    seconds = diff%60;
    var result = days + " ngay " + hours + " gio " + mimutes + " phut " + seconds + " giay";
    if((date_end-current_date)<0){
    	result = "hết hạn đăng kí";
    }
    if((current_date - date_start) < 0){
    	result = "Chưa đến thời gian đăng kí";
    }
    $("#resulttime").empty();
    $("#resulttime").append(result);
}, 1000);
</script>
@endsection