@extends('frontend/layout/master')
@section('style-bot')
{{ HTML::style('public/assets/css/upload.css') }}
@stop
@section('script-bot')
{{ HTML::script('public/assets/js/upload.js') }}
@stop
@section('width_70per')
	width_70per
@stop
@section('title')
	Photo Upload
@stop
@section('content')
    
    @if(Session::get('status') == 'success')
    <p class="alert-success">Saved</p>
    @elseif (Session::get('status') == 'false')
    @foreach(Session::get('errors_message') as $error_message)
    <p class="alert-danger">
        {{$error_message}}
    </p>
    @endforeach
    @endif
    <div id='upload-tabs' class="upload_content col-md-10 center-block">
          <ul>
            <li><a href="#upload-image-tabs">Upload Images</a></li>
            <li><a href="#upload-album-tabs">Upload Album</a></li>
          </ul>
        <div class='upload-image-form-template'>
            <ul>
                <li>
                    <p>Category</p>
                    <select name="category[]">
                        @foreach($categories as $index => $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </select>
                </li>
                <li>
                    <p>Title</p>
                    <input class="form-control" placeholder="Title" name="title[]">
                </li>
                <li>
                    <p>Caption</p>
                    <textarea class="form-control" placeholder="Caption for image" name="caption[]"></textarea>
                </li>
                <li>
                    <p>Public</p>
                    <select name='public[]'>
                        <option value='1' selected='true'>Yes</option>
                        <option value='2'>No</option>
                    </select>
                </li>
            </ul>
            
        </div>
		<div id='upload-image-tabs' class="upload_left">
            
                {{ Form::open(array('url'=>'image','files'=>true, 'method' => 'POST', 'id' => 'upload-image-form')) }}
                <div id="images-description" style="display: none"></div>
                <h1>Upload images</h1>
                <!--<p class="note">Use <span>Select image</span> to s Đăng <span>tẹt ga thoải con gà mái nhé</span>!</p>-->
                <div class='upload-image-form'>
                    <ul>
                        <li>
                            <p class="control-label">Select image</p>
                            <p>{{Form::file('path[]', array("accept" => "image/*", "class" => "single form-control", 'multiple' => 'true'))}}</p>
                            <!--<p><img class='img-rounded img-thumbnail'></p>-->
                        </li>
                        
                    </ul>
                    
                </div>
                <div id="files-array-single" class="hidden"></div>
                <p><input type="submit" class="btn btn-default" value="Upload"></p>
            {{Form::close()}}
        </div>
		<div id='upload-album-tabs' class="upload_right">
            {{ Form::open(array('url'=>'album','files'=>true, 'method' => 'POST')) }}
                <h1>Upload album</h1>
                <!--<p class="note">Sử dụng nút <span>Chọn ảnh</span> để chọn ảnh cho album của bạn. Đăng <span>tẹt ga thoải con gà mái nhé</span>!</p>-->
                <div>
                    <ul>
                        <li>
                            <p>Select image</p>
                            <p>{{Form::file('path[]', array("accept" => "image/*", "class" => "multiple form-control", 'multiple' => 'true'))}}</p>
                            <div class='album-preview'></div>
                        </li>
                        <li>
                            <p>Category</p>
                            <select name="category_id">
                                @foreach($categories as $index => $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </li>
                        <li>
                            <p>Title</p>
                            <input class="form-control" placeholder="Title" name="title">
                        </li>
                        <li>
                            <p>Description</p>
                            <textarea class="form-control" placeholder="Description" name='description'></textarea>
                        </li>
                        <li>
                            <p>Public</p>
                            <select name='public'>
                                <option value='1' selected='true'>Yes</option>
                                <option value='2'>No</option>
                            </select>
                        </li>
                    </ul>
                </div>
                <p><input type="submit" class="btn btn-default" value="Upload"></p>
                <div id="files-array-multiple" class="hidden"></div>
            {{Form::close()}}
        </div>
	</div>
    <div class="clearfix"></div>
@stop