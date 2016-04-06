@extends('frontend/layout/master')
@section('style-bot')
{{ HTML::style('public/assets/css/albums-images/show.css') }}
{{ HTML::style('public/assets/css/images/show.css') }}
@stop
@section('script-bot')
{{ HTML::script('public/assets/js/images/show.js') }}
{{ HTML::script('public/assets/js/albums-images/show.js') }}
<script type="text/javascript">
</script>
@stop
@section('title')
    Single Image Viewer
@stop
@section('content')
@if(Session::get('status') == 'success')
@foreach(Session::get('messages') as $message)
<p class="alert-success">
    {{$message}}
</p>
@endforeach

@elseif (Session::get('status') == 'false')
<p class="alert-danger">Failed</p>
@foreach(Session::get('messages') as $message)
<p class="alert-danger">
    {{$message}}
</p>
@endforeach
@endif
<div class="image_content row">
    
    {{ Form::open(array('url'=>'image/'.$image->id,'files'=>true, 'method' => 'PATCH', 'id' => 'upload-image-form')) }}
		<div class="image_left col-md-8">
            <article>
                <div class="detail_image_header">
                    <h2 class="detail_image_title">
                        Title<br/>
                        <input type='text' class='form-control' name='title' value='{{$image->album->title}}'>
                    </h2>
                </div>
                <ul class="detail_image_info">
                    <li class="detail_image_info_date"><span >{{$image->updated_at}}</span></li>
                    <li class="detail_image_info_count_like"><span class="like"><i class="glyphicon glyphicon-heart"></i> <span>{{$image->count_like}}</span></span></li>
                    
                </ul>
                <div class="photo_content">
                    <a href='{{Asset('image/'.$image->id)}}'>
                        <img class="img-rounded image-view" src="{{url('public/'.$image->path)}}" alt="{{$image->album->title}}">
                    </a>
                    <p>
                        <label class="caption">Caption:</label>
                        <textarea class='form-control' name='caption'>{{$image->caption}}</textarea>
                    </p>
                </div>
            </article>
            <p>
                <input type='submit' class='btn btn-primary' value='Save'>
            </p>
            
		</div>
		<div class="image_right col-md-4">
			@include('frontend/components/image_user_info',array('image' => $image))
            {{Form::close()}}
            
		</div>
        {{ Form::open(array('url'=>'image/'.$image->id,'files'=>true, 'method' => 'DELETE', 'id' => 'upload-image-form')) }}
        <div class="col-md-5">
            <input type="submit" class="btn btn-danger delete-image" value="Delete">
        </div>
        {{Form::close()}}
        <div class='clearfix'></div>
        
	</div>

@stop