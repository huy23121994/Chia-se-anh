@extends('frontend/layout/master')
@section('content')
<h1>Edit User</h1>
{{ Form::model($user, array('method' => 'POST', 'route' =>array('Details.update', $user->id))) }}

<div class="form-group">
	<label class="control-label col-sm-2" for="name">Full name</label>
	<div class="col-sm-10">
		{{Form::text('name', null, array('class'=>'form-control', 'id'=>'name','placeholder'=>'Full name'))}}
	</div>
</div>

<div class="form-group">
	<label class="control-label col-sm-2" for="address">Address</label>
	<div class="col-sm-10">
		{{Form::textarea('address', null, array('class'=>'form-control', 'id'=>'address','placeholder'=>'Address', 'rows'=>3))}}
	</div>
</div>
<div class="form-group">
	<label class="control-label col-sm-2" for="description">Phone</label>
	<div class="col-sm-10">
		{{Form::text('phone', null, array('class'=>'form-control', 'id'=>'phone','placeholder'=>'Phone'))}}
	</div>
</div>


<div class="box-footer">
	<div class="form-group">
		<label class="control-label col-sm-2">&nbsp;</label>
		<div class="col-sm-10">
			<button class="btn btn-sm btn-success" type="submit">Submit</button>
			<button class="btn btn-sm btn-default" type="reset">Reset</button>
		</div>
	</div>
	<div class="clearfix"></div>
</div>

{{ Form::close() }}
@if ($errors->any())
<ul>
	{{ implode('', $errors->all('<li class="error">:message</li>')) }}
</ul>
@endif
@stop