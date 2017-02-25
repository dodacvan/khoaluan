@extends('giaovien.master')
@section('controller','Thay đổi')
@section('action','Thông tin')
@section('content')
<div class="col-lg-7" style="padding-bottom:120px">
    <form action="" method="POST">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="txtemail" placeholder="" value="{!! old('txtemail',isset($data)?$data['email']:'txtemail') !!}"/>
        </div>
            @if($errors->first('txtemail'))
                <div class="alert alert-danger">
            {!! $errors->first('txtemail') !!}
        </div>
        @endif
  
        <div class="form-group">
            <label>Địa chỉ</label>
            <input type="text" class="form-control" name="txtdiachi" placeholder="" value="{!! old('txtdiachi',isset($data)?$data['diachi']:'txtdiachi') !!}" />
        </div>
        @if($errors->first('txtdiachi'))
            <div class="alert alert-danger">
            	{!! $errors->first('txtdiachi') !!}
            </div>
        @endif

        <div class="form-group">
            <label>Quê quán</label>
            <input type="text" class="form-control" name="txtquequan" placeholder="" value="{!! old('txtquequan',isset($data)?$data['quequan']:'txtquequan') !!}" />
        </div>
        @if($errors->first('txtquequan'))
            <div class="alert alert-danger">
                {!! $errors->first('txtquequan') !!}
            </div>
        @endif

        <div class="form-group">
            <label>Cell phone</label>
            <input type="text" class="form-control" name="txtsdt" placeholder="" value="{!! old('txtsdt',isset($data)?$data['sdt']:'txtsdt') !!}" />
        </div>
        @if($errors->first('txtsdt'))
            <div class="alert alert-danger">
                {!! $errors->first('txtsdt') !!}
            </div>
        @endif

        <div class="form-group">
            <label>NewPassword</label>
            <input type="password" class="form-control" name="txtPass" placeholder="Please Enter Password" />
        </div>
        @if($errors->first('txtPass'))
            <div class="alert alert-danger">
                {!! $errors->first('txtPass') !!}
            </div>
        @endif

        <div class="form-group">
            <label>RePassword</label>
            <input type="password" class="form-control" name="txtRePass" placeholder="Please Enter RePassword" value=""/>
        </div>
        @if($errors->first('txtRePass'))
            <div class="alert alert-danger">
                {!! $errors->first('txtRePass') !!}
            </div>
        @endif
        <button type="submit" class="btn btn-default">Edit</button>
        <button type="reset" class="btn btn-default">Reset</button>
    <form>
</div>

@endsection()
