@extends('giaovu.master')
@section('controller','Sửa')
@section('action','Thông báo')
@section('content')
<form enctype="multipart/form-data" action="" method="POST">
<div class="col-lg-6">  
		<input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="form-group">
            <label>Tiêu đề</label>
            <input class="form-control" name="title" value="{!! old('title',isset($data)?$data['title']:'title')!!}" />
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
            <textarea class="form-control" rows="12" name="content">{!! $data['content'] !!}</textarea>
        </div>
		@if($errors->first('content'))
                <div class="alert alert-danger">
		{!! $errors->first('content') !!}
	    </div>
		@endif
		<button type="submit" class="btn btn-info">Sửa</button>
        <button type="reset" class="btn btn-default">Thiết lập lại</button>
</div>
 <form>
@endsection