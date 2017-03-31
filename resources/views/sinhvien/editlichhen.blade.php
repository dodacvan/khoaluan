@extends('sinhvien.master')
@section('controller','Lịch hẹn')
@section('action','')
@section('content')
<form enctype="multipart/form-data" action="" method="POST">
<div class="col-lg-6" style="padding-bottom:120px">
		<label>Sinh viên:{!! $giaovien['tengiaovien'] !!}</label> 
		<input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <input type="hidden" name="id" value="{!! $data['id'] !!}">
        <div class="form-group">
            <label>Tiêu đề</label>
            <input class="form-control" name="title" value="{!! old('title',isset($data)?$data['tieude']:'title')!!}" />
        </div>
        @if($errors->first('title'))
                <div class="alert alert-danger">
		{!! $errors->first('title') !!}
	    </div>
		@endif

		<div class="form-group">
            <label>Thời gian</label>
            <input class="form-control" type="datetime-local" name="time"/>
        </div>
        @if($errors->first('time'))
                <div class="alert alert-danger">
		{!! $errors->first('time') !!}
	    </div>
		@endif

		<div class="form-group">
            <label>Địa điểm</label>
            <input class="form-control" name="place"  value="{!! old('place',isset($data)?$data['diadiem']:'place')!!}" />
        </div>
       	@if($errors->first('place'))
                <div class="alert alert-danger">
		{!! $errors->first('place') !!}
	    </div>
		@endif
		<button type="submit" class="btn btn-info">Gửi</button>
        <button type="reset" class="btn btn-default">Thiết lập lại</button>  
</div>
 <form>
@endsection