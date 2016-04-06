@extends('frontend/layout/master')
@section('content')
<h1>Chuyên mục {{ $data['category']->title }}</h1>
	<div class="container-div">
		<ul>
			@foreach($data['albums'] as $index => $album)
            @if($album->is_single == 0)
            <li class="item-image album">
                @include('frontend/components/album', array('album' => $album))
            </li>
            @elseif($album->is_single == 1)
            <li class="item-image image">
                @include('frontend/components/image', array('image' => $album->getImages()->first()))
            </li>
            @endif
            @endforeach
		</ul>
	</div>
@stop
