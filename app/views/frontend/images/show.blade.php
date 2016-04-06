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
<div class="image_content row">
		<div class="image_left col-md-8">
            <article>
                <div class="detail_image_header">
                    <h2 class="detail_image_title">{{$image->title}}</h2>
                </div>
                <ul class="detail_image_info">
                    <li class="detail_image_info_date"><span >{{$image->updated_at}}</span></li>
                    <li class="detail_image_info_count_like"><span class="like"><i class="glyphicon glyphicon-heart"></i> <span>{{$image->count_like}}</span></span></li>
                    <li class="detail_image_info_count_share"><span class="share"><i class='glyphicon glyphicon-share'></i> <span>{{$image->count_share}}</span></span></li>
                </ul>
                <div class="photo_content">
                    <a href='{{Asset('image/'.$image->id)}}'>
                        <img class="img-rounded image-view" src="{{url('public/'.$image->path)}}" alt="{{$image->album->title}}">
                    </a>
                    <p>
                        <label class="caption">Caption: </label>
                        <p>{{$image->caption}}</p>
                    </p>
                </div>
            </article>
		</div>
		<div class="image_right col-md-4">
			@include('frontend/components/image_user_info',array('image' => $image))
            
            @include('frontend/components/comment_box',array('post' => $image))
		</div>
	</div>
@stop