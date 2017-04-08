@extends('giaovien.master')
@section('content')
<div class="post-listing">
    <article class="item-list">
        <h2 class="post-box-title">{{ $data['title'] }}</h2>
        <p class="post-meta">
            cập nhật
            <span><?php $timestamp = strtotime($data['updated_at']);
         echo date("d/m/Y",$timestamp);?></span>    
            
        </p>  
        <div class="clear"></div>
        <div class="entry">
            <?php echo nl2br($data['content']); ?>
        </div>
        <div class="clear"></div>
    </article>
</div>
<a href="{!! URL::previous() !!}" class="btn btn-default">Back</a>
@endsection()