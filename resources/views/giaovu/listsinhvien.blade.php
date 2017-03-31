@extends('giaovu.master')
@section('controller','Danh sách')
@section('action','Sinh viên')
@section('content')
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th style="width: 50px">STT</th>
            <th>Mã sinh viên</th>
            <th>Tên</th>
            <th>Lớp</th>
            <th>Email</th>
            <th>Ngành</th>
            <th>Trạng thái</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php $stt=0; ?>
                    @foreach($data as $item)
                            <tr class="odd gradeX" align="center">
                                <td>{!! ++$stt; !!}</td>
                                <td>{!! $item['masinhvien'] !!}</td>
                                <td><a href="{!! URL::route('giaovu.infosinhvien', $item['id']) !!}">{!! $item['ten'] !!}</a></td>
                                <td>{!! $item['lop'] !!}</td>
                                <td>{!! $item['email'] !!}</td>
                                <td>{!! $item['nganh'] !!}</td>
                            @if($item['magiaovien']==0)
                                <td style="color: yellow">Chưa đăng kí</td>
                            @else
                                <td style="color: green">Đã đăng kí</td>
                            @endif
                             <td class="center"><i class="fa fa-trash-o  fa-fw"></i> Delete</td>
                            </tr>
                        @endforeach
    </tbody>
</table>
@endsection()