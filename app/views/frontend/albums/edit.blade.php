@extends('frontend/layout/master')
@section('style-bot')
{{ HTML::style('public/assets/css/albums-images/show.css') }}
{{ HTML::style('public/assets/css/albums/show.css') }}
@stop
@section('script-bot')
{{ HTML::script('public/assets/js/albums/jquery-ui-1.10.3.custom.min.js') }}
{{ HTML::script('public/assets/js/albums/jquery.kinetic.min.js') }}
{{ HTML::script('public/assets/js/albums/jquery.mousewheel.min.js') }}
{{ HTML::script('public/assets/js/albums/jquery.smoothdivscroll-1.3-min.js') }}
{{ HTML::script('public/assets/js/albums-images/show.js') }}
{{ HTML::script('public/assets/js/albums/show.js') }}
@stop
@section('width_70per')
	width_70per
@stop
@section('title')
	Album Viewer
@stop
@section('content')


<div class="image_content row">
    <div class="image_left col-md-8">
        <article>
            <div class="detail_image_header">
                <h2 class="detail_image_title">{{$album->title}}</h2>
            </div>
            <ul class="detail_image_info">
                <li class="detail_image_info_date"><span >{{$album->updated_at}}</span></li>
                <li class="detail_image_info_count_like"><span class="like"><i class="glyphicon glyphicon-heart"></i> <span>{{$album->count_like}}</span></span></li>
                <li class="detail_image_info_count_share"><span class="share"><i class='glyphicon glyphicon-share'></i> <span>{{$album->count_share}}</span></span></li>
            </ul>
            <div class="photo_content">
                <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                    @foreach($album->getImages() as $index => $image)
                    <li data-thumb="{{url('public/'.$image->path)}}"> 
                        <a href='{{url('image/'.$image->id)}}'><img class='preview' src="{{url('public/'.$image->path)}}" /></a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </article>

    </div>
    <div class="image_right col-md-4">
        @include('frontend/components/album_user_info', array('album',$album))
        @include('frontend/components/comment_box',array('post' => $album))
        
    </div>
</div>
@stop
