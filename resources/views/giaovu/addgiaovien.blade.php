@extends('giaovu.master')
@section('controller','Thêm')
@section('action','Giáo viên')
@section('content')
<div class="container">
		<a href="{{ URL::to('downloadExcel/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
		<a href="{{ URL::to('downloadExcel/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
		<a href="{{ URL::to('downloadExcel/csv') }}"><button class="btn btn-success">Download CSV</button></a>
		<form  action="{{ URL::to('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{!! csrf_token() !!}">
			<label>Chọn file</label>
			<input type="file" name="import_file" />
			<button class="btn btn-primary">Import File</button>
		</form>
	</div>
<form enctype="multipart/form-data" action="" method="POST">
<div class="col-lg-6" style="padding-bottom:120px">  
		<input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="form-group">
            <label>Tên giáo viên</label>
            <input class="form-control" name="txtName" placeholder="Điền tên giáo viên" value="{!! old('txtName') !!}" />
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

		<div class="form-group">
            <label>Quê quán</label>
            <input class="form-control" name="txtProvince" placeholder="Điền quê quán - tỉnh /thành phố" value="{!! old('txtProvince') !!}" />
        </div>
		@if($errors->first('txtProvince'))
                <div class="alert alert-danger">
		{!! $errors->first('txtProvince') !!}
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
            <label>Chức danh</label>
            <select class="form-control" name="txtTitle">
					<option value="0"></option>
					<option value="1">GV</option>
					<option value="2">GVC</option>
					<option value="3">NVC</option>
					<option value="4">GVTH</option>
					<option value="5">GVCC</option>
			 </select>
        </div>
		@if($errors->first('txtTitle'))
                <div class="alert alert-danger">
		{!! $errors->first('txtTitle') !!}
	    </div>
		@endif

		<div class="form-group">
            <label>Học hàm</label>
            <select class="form-control" name="txtAcademic">
					<option value="0"></option>
					<option value="1">Phó giáo sư</option>
					<option value="2">Giáo sư</option>
			 </select>
        </div>
		@if($errors->first('txtAcademic'))
                <div class="alert alert-danger">
		{!! $errors->first('txtAcademic') !!}
	    </div>
		@endif

		<div class="form-group">
            <label>Học vị</label>
            <select class="form-control" name="txtDegree">
					<option value="0"></option>
					<option value="1">Cử nhân</option>
					<option value="2">Thạc sĩ</option>
					<option value="3">Tiến sĩ</option>
			 </select>
        </div>
		@if($errors->first('txtDegree'))
                <div class="alert alert-danger">
		{!! $errors->first('txtDegree') !!}
	    </div>
		@endif

		<div class="form-group">
            <label>Khoa</label>
            <select class="form-control" name="txtDepart" id="gvdepart">
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
		@endif

		<div class="form-group">
            <label>Bộ môn</label>
            <select class="form-control" name="txtSubject" id="gvclass">
					<option value="1">Công nghệ phần mềm</option>
					<option value="2">Hệ thống thông tin</option>
					<option value="3">Khoa học máy tính</option>
					<option value="4">Mạng và truyền thông máy tính</option>
					<option value="5">Các PP toán trong CN</option>
					<option value="6">PTN Công nghệ tri thức</option>
					<option value="7">PTN hệ thống nhúng</option>
					<option value="8">PTN Tương tác người máy</option>
			 </select>
        </div>
		@if($errors->first('txtSubject'))
                <div class="alert alert-danger">
		{!! $errors->first('txtSubject') !!}
	    </div>
		@endif
                            
        <button type="submit" class="btn btn-info">Thêm</button>
        <button type="reset" class="btn btn-default">Thiết lập lại</button>
   
</div>
 <form>
@endsection