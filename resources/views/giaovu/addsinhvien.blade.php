@extends('giaovu.master')
@section('controller','Thêm')
@section('action','Sinh viên')
@section('content')
<form  action="{{ URL::to('SVimport') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
	<div class="col-lg-12">
		<input type="hidden" name="_token" value="{!! csrf_token() !!}">
		<div class="form-group">
			<label>Chọn file</label>
			<input type="file" name="import_file" />
		</div>
		<button class="btn btn-primary">Import File</button>
	</div>
</form>
<form enctype="multipart/form-data" action="" method="POST">
<div class="col-lg-6" style="padding-bottom:120px">  
		<input type="hidden" name="_token" value="{!! csrf_token() !!}">
		<div class="form-group">
            <label>Mã sinh viên</label>
            <input class="form-control" name="txtCode" placeholder="Điền mã sinh viên" value="{!! old('txtCode') !!}" />
        </div>
		@if($errors->first('txtCode'))
                <div class="alert alert-danger">
		{!! $errors->first('txtCode') !!}
	    </div>
		@endif

        <div class="form-group">
            <label>Tên sinh viên</label>
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

        <div class="form-group">
            <label>Cellphone</label>
            <input class="form-control" name="txtCellphone" placeholder="Điền số điện thoại" value="{!! old('txtCellphone') !!}"/>
        </div>
		@if($errors->first('txtCellphone'))
                <div class="alert alert-danger">
		{!! $errors->first('txtCellphone') !!}
	    </div>
		@endif
 
		<button type="submit" class="btn btn-info">Thêm</button>
        <button type="reset" class="btn btn-default">Thiết lập lại</button>
</div>
<div class="col-lg-6" style="padding-bottom:120px">
        <div class="form-group">
            <label>Địa chỉ</label>
            <input class="form-control" name="txtAddress" placeholder="Điền địa chỉ" value="{!! old('txtAddress') !!}"/>
        </div>
		@if($errors->first('txtAddress'))
                <div class="alert alert-danger">
		{!! $errors->first('txtAddress') !!}
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


		<!-- <div class="form-group">
            <label>Khoa</label>
            <select class="form-control" name="txtDepart" id="svdepart">
				<option value="0">CNTT</option>
				<option value="1">Vật lý kĩ thuật và công nghệ nano</option>
				<option value="2">Điện tử viễn thông</option>
				<option value="3">Cơ học kĩ thuật và tự động hóa</option>
			 </select>
        </div>
		@if($errors->first('txtDepart'))
                <div class="alert alert-danger">
		{!! $errors->first('txtDepart') !!}
	    </div>
		@endif -->

		<div class="form-group">
            <label>Ngành</label>
            <select class="form-control" name="txtAcademic" id="svacademic">
					<option value="CNTT">CNTT</option>
					<option value="Khoa học máy tính">Khoa học máy tính</option>
					<option value="Hệ thống thông tin">Hệ thống thông tin</option>
					<option value="Truyền thông và mạng máy tính">Truyền thông và mạng máy tính</option>
			 </select>
        </div>
		@if($errors->first('txtAcademic'))
                <div class="alert alert-danger">
		{!! $errors->first('txtAcademic') !!}
	    </div>
		@endif

		<div class="form-group">
            <label>Lớp</label>
            <select class="form-control" name="txtClass">
					<option value="58cd">K58 CD</option>
					<option value="58cc">K58 CC</option>
					<option value="58cb">K58 CB</option>
					<option value="58ca">K58 CA</option>
			 </select>
        </div>
		@if($errors->first('txtClass'))
                <div class="alert alert-danger">
		{!! $errors->first('txtClass') !!}
	    </div>
		@endif

		
                            
   
</div>
 <form>
@endsection