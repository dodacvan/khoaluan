@extends('giaovu.master')
@section('controller','Thêm')
@section('action','Giáo viên')
@section('content')
		<!-- <a href="{{ URL::to('downloadExcel/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
		<a href="{{ URL::to('downloadExcel/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
		<a href="{{ URL::to('downloadExcel/csv') }}"><button class="btn btn-success">Download CSV</button></a> -->

		<form  action="{{ URL::to('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
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
            <input type="email" class="form-control" name="txtemail" placeholder="Điền email" value="{!! old('txtemail') !!}"/>
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
            <label>Chức danh</label>
            <select class="form-control" name="txtTitle">
					<option value=""></option>
					<option value="GV">GV</option>
					<option value="GVC">GVC</option>
					<option value="NVC">NVC</option>
					<option value="GVTH">GVTH</option>
					<option value="GVCC">GVCC</option>
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
					<option value=""></option>
					<option value="PGS">Phó giáo sư</option>
					<option value="GS">Giáo sư</option>
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
					<option value=""></option>
					<option value="CN">Cử nhân</option>
					<option value="Ths">Thạc sĩ</option>
					<option value="TS">Tiến sĩ</option>
			 </select>
        </div>
		@if($errors->first('txtDegree'))
                <div class="alert alert-danger">
		{!! $errors->first('txtDegree') !!}
	    </div>
		@endif

		<!-- <div class="form-group">
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
		@endif -->

		<div class="form-group">
            <label>Bộ môn</label>
            <select class="form-control" name="txtSubject" id="gvclass">
					<option value="Công nghệ phần mềm">Công nghệ phần mềm</option>
					<option value="Hệ thống thông tin">Hệ thống thông tin</option>
					<option value="Khoa học máy tính">Khoa học máy tính</option>
					<option value="Mạng và truyền thông máy tính">Mạng và truyền thông máy tính</option>
					<option value="Các PP toán trong CN">Các PP toán trong CN</option>
					<option value="PTN Công nghệ tri thức">PTN Công nghệ tri thức</option>
					<option value="PTN hệ thống nhúng">PTN hệ thống nhúng</option>
					<option value="PTN Tương tác người máy">PTN Tương tác người máy</option>
			 </select>
        </div>
		@if($errors->first('txtSubject'))
                <div class="alert alert-danger">
		{!! $errors->first('txtSubject') !!}
	    </div>
		@endif
                            
   
</div>
 <form>
@endsection