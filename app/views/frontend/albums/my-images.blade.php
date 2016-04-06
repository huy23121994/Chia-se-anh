@extends('frontend/layout/master')
@section('style-bot')
{{ HTML::style('public/assets/css/users/view-images.css') }}
@stop
@section('title')
	Chia sẻ ảnh trực tuyến
@stop
@section('content')
	<div class="container-div">
		<ul>
			@foreach($albums as $index => $album)
            @if($album->is_single == 0)
            <li class="item-image album">
                @include('frontend/components/album', array('album' => $album))
                <div class="action-buttons pull-right">
                    <a href="{{url('album/'.$album->id.'/edit')}}">
                        <button class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></button>
                    </a>
                </div>
            </li>
            @elseif($album->is_single == 1)
            <li class="item-image album">
                @include('frontend/components/image', array('image' => $album->getImages()->first()))
                <div class="action-buttons pull-right">
                    <a href="{{url('image/'.$album->id.'/edit')}}">
                        <button class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></button>
                    </a>
                </div>
            </li>
            @endif
            @endforeach
		</ul>
	</div>
@stop
