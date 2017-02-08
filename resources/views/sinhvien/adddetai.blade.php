@extends('sinhvien.master')
@section('controller','Đăng kí')
@section('action','')
@section('content')
<form enctype="multipart/form-data" action="" method="POST">
<div class="col-lg-6" style="padding-bottom:120px">
		<label>Giáo viên:{!! $data['tengiaovien'] !!}</label> 
		<input type="hidden" name="_token" value="{!! csrf_token() !!}">
		<input type="hidden" name="giaovien_id" value="{!! $data['id'] !!}">
		<input type="hidden" name="sinhvien_id" value="{!! Auth::user()->id !!}">
        <div class="form-group">
            <label>Tên đề tài</label>
            <input class="form-control" name="detai" placeholder="Điền tên để tài" value="" />
        </div>
        @if($errors->first('detai'))
                <div class="alert alert-danger">
		{!! $errors->first('detai') !!}
	    </div>
		@endif
		<button type="submit" class="btn btn-info">Gửi</button>
        <button type="reset" class="btn btn-default">Thiết lập lại</button>  
</div>
 <form>
@endsection