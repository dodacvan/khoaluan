@extends('giaovu.master')
@section('controller','Danh sách')
@section('action','Giáo viên')
@section('content')
<a href="{{ URL::route('giaovu.excelgiaovien') }}"><button class="btn btn-success" style="margin-bottom: 10px;">Xuất ra excel</button></a>
<a href="{{ URL::route('giaovu.chartgiaovien') }}"><button class="btn btn-success" style="margin-bottom: 10px;">Biểu đồ</button></a>
<div class="container">
<form action="" method="get" class="form-inline">
    <div class="form-group" style="float: left">
        <label>Bộ môn</label>
        <select name="bomon" class="custom-select">
            <option value="">Tất cả</option>
           @foreach ($bomon as $item)
                <option value="{!! $item !!}" {!! ($item == $bomonselect)?"selected":"" !!}>{!! $item !!}</option>
           @endforeach
        </select>  
    </div>
    <div class="type" style="float: left; margin-left: 10px">
        <label>Trạng thái</label>
        <select name="type" class="custom-select">
            <option value="">Tất cả</option>
            <option value="false" {!! ($typeselect == "false")?"selected":"" !!}>Đã nhận đủ</option>
            <option value="true" {!! ($typeselect == "true")?"selected":"" !!}>Chưa nhận đủ</option>
        </select>
    </div>
    <button type="submit" style="float: left; margin-left: 10px; margin-top: -10px;" class="btn btn-info">Duyet</button>
</form>
</div>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th style="width: 50px">STT</th>
            <th>Tên</th>
            <th>Điện thoại</th>
            <th>Email</th>
            <th>Bộ môn</th>
            <th>Số sinh viên hướng dẫn</th>
        </tr>
    </thead>
    <tbody>
    <?php $stt=0; ?>
                    @foreach($data as $item)
                            <?php
                                switch ($item['hocvi']) {
                                            case "":
                                                $number = 0;
                                                break;
                                            case "CN":
                                                $number = 0;
                                                break;
                                            case "Ths":
                                                $number = 3;
                                                break;
                                            default:
                                                $number = 5;
                                                break;
                                        }
                            ?>
                            @if($item['sosinhvien']==$number)
                                <tr class="odd gradeX" align="center" style="background:#ea6868">
                            @else
                                <tr class="odd gradeX" align="center" style="background:#84f19a">
                            @endif
                                <td>{!! ++$stt; !!}</td>
                                <td><a href="{!! URL::route('giaovu.infogiaovien', $item['id']) !!}">{!! $item['tengiaovien'] !!}</a></td>
                                <td>{!! $item['sdt'] !!}</td>
                                <td>{!! $item['email'] !!}</td>

                                 <td>{!! $item['bomon'] !!}</td>
                                <td>{!! $item['sosinhvien'].'/'.$number !!}</td>
                            </tr>
                        @endforeach
    </tbody>
</table>
@endsection()