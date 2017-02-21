@extends('layouts.app')

@section('content')

<h2 class="well"> Add a New Item: </h2>

<!-- will be used to show any messages -->
@if (Session::has('message'))
<div class="alert alert-info alert-dismissable fade in">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	{{Session::get('message')}}
</div>
@endif

<div class="row">
	<div class="col col-md-8 col-md-offset-2">
		@foreach($errors->all() as $error)
		<div class="alert alert-danger alert-dismissable fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>danger!</strong> {{$error}}.
		</div>
		@endforeach
		{!!Form::open(['method'=>'POST', 'route' => ['items.store']])!!}
		<div class="form-group {{$errors->has('name') ? ' has-error has-feedback' : ''}}">
			{!! Form::label('name', 'Name', ['class'=>'control-label sr-only']) !!}
			<div class="input-group">
				<span class="input-group-addon">Name</span>
				{!! Form::text('name', Input::old('name'), 
				['class' => 'form-control', 'placeholder'=>'Name']) !!}
			</div>
			@if ($errors->has('name'))
			<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
			<span class="help-block">{{ $errors->first('name') }}</span>
			@endif
		</div>

		<div class="form-group {{$errors->has('description') ? ' has-error has-feedback' : ''}}">
			{!! Form::label('description', 'Description', ['class'=>'control-label sr-only']) !!}
			<div class="input-group">
				<span class="input-group-addon">Description</span>
				{!! Form::textarea('description', Input::old('description'), 
				['class' => 'form-control', 'placeholder'=>'Description']) !!}
			</div>
			@if ($errors->has('description'))
			<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
			<span class="help-block">{{ $errors->first('description') }}</span>
			@endif
		</div>

		<div class="form-group {{$errors->has('price') ? ' has-error has-feedback' : ''}}">
			{!! Form::label('price', 'Price', ['class'=>'control-label sr-only']) !!}
			<div class="input-group">
				<span class="input-group-addon">Price</span>
				{!! Form::number('price', Input::old('price'), 
				['class' => 'form-control', 'placeholder'=>'Price']) !!}
			</div>
			@if ($errors->has('price'))
			<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
			<span class="help-block">{{ $errors->first('price') }}</span>
			@endif
		</div>

		<div class="form-group {{$errors->has('category_id') ? ' has-error has-feedback' : ''}}">
			{!! Form::label('category_id', 'Category', ['class'=>'control-label sr-only']) !!}
			<div class="input-group">
				<span class="input-group-addon">Category</span>
				{!! Form::select('category_id',  $categories->pluck('name','id'),
				Input::old('category_id'), ['class' => 'form-control']) !!}
			</div>
			@if ($errors->has('category_id'))
			<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
			<span class="help-block">{{ $errors->first('category_id') }}</span>
			@endif
		</div>

		<div class="form-group {{$errors->has('location_id') ? ' has-error has-feedback' : ''}}">
			{!! Form::label('location_id', 'Location', ['class'=>'control-label sr-only']) !!}
			<div class="input-group">
				<span class="input-group-addon">Location</span>
				{!! Form::select('location_id',  $locations->pluck('name','id'),
				Input::old('location_id'), ['class' => 'form-control']) !!}
			</div>
			@if ($errors->has('location_id'))
			<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
			<span class="help-block">{{ $errors->first('location_id') }}</span>
			@endif
		</div>

		<div class="form-group">
			{!!Form::submit('Save', ['class'=>'form-controll btn btn-success'])!!}
		</div>
		{!!Form::close()!!}
	</div>
</div>
@endsection
