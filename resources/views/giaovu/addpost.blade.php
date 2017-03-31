@extends('giaovu.master')
@section('controller','Thêm')
@section('action','Thông báo')
@section('content')
<form enctype="multipart/form-data" action="" method="POST">
<div class="col-lg-6">  
		<input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="form-group">
            <label>Tiêu đề</label>
            <input class="form-control" name="title" placeholder="Điền tiêu đề" value="{!! old('title') !!}" />
        </div>
		@if($errors->first('title'))
                <div class="alert alert-danger">
		{!! $errors->first('title') !!}
	    </div>
		@endif
</div>
<div class="col-lg-12" style="padding-bottom:120px">
        <div class="form-group">
            <label>Nội dung</label>
            <textarea class="form-control" rows="20" name="content"></textarea>
        </div>
		@if($errors->first('content'))
                <div class="alert alert-danger">
		{!! $errors->first('content') !!}
	    </div>
		@endif
		<button type="submit" class="btn btn-info">Thêm</button>
        <button type="reset" class="btn btn-default">Thiết lập lại</button>
</div>
 <form>
@endsection