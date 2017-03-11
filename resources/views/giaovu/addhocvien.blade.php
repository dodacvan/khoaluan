@extends('giaovu.master')
@section('controller','Thêm')
@section('action','Học viên')
@section('content')
<form enctype="multipart/form-data" action="" method="POST">
<div class="col-lg-6" style="padding-bottom:120px">  
		<input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="form-group">
            <label>Tên học viên</label>
            <input class="form-control" name="txtName" placeholder="Điền tên sinh viên" value="{!! old('txtName') !!}" />
        </div>
		@if($errors->first('txtName'))
                <div class="alert alert-danger">
		{!! $errors->first('txtName') !!}
	    </div>
		@endif

        <div class="form-group">
            <label>Email</label>
            <input class="form-control" name="txtemail" placeholder="Điền email" value="{!! old('txtemail') !!}"/>
        </div>
		@if($errors->first('txtemail'))
                <div class="alert alert-danger">
		{!! $errors->first('txtemail') !!}
	    </div>
		@endif
				
        <div class="form-group">
            <label>Ngày sinh</label>
            <input class="form-control" name="txtBirth" type="date" value="{!! old('txtBirth') !!}" />
        </div>
		@if($errors->first('txtBirth'))
                <div class="alert alert-danger">
		{!! $errors->first('txtBirth') !!}
	    </div>
		@endif
		<button type="submit" class="btn btn-info">Thêm</button>
        <button type="reset" class="btn btn-default">Thiết lập lại</button>
</div>
<div class="col-lg-6" style="padding-bottom:120px">
		<div class="form-group">
            <label>Cellphone</label>
            <input class="form-control" name="txtCellphone" placeholder="Điền số điện thoại" value="{!! old('txtCellphone') !!}"/>
        </div>
		@if($errors->first('txtCellphone'))
                <div class="alert alert-danger">
		{!! $errors->first('txtCellphone') !!}
	    </div>
		@endif

		<div class="form-group">
            <label>Giới tính</label>
            <select class="form-control" name="txtSex">
					<option value="1">Nam</option>
					<option value="2">Nữ</option>
			 </select>
        </div>
		@if($errors->first('txtSex'))
                <div class="alert alert-danger">
		{!! $errors->first('txtSex') !!}
	    </div>
		@endif
			
        <div class="form-group">
            <label>Địa chỉ</label>
            <input class="form-control" name="txtAddress" placeholder="Điền địa chỉ" value="{!! old('txtAddress') !!}"/>
        </div>
		@if($errors->first('txtAddress'))
                <div class="alert alert-danger">
		{!! $errors->first('txtAddress') !!}
	    </div>
		@endif                  
</div>
 <form>
@endsection