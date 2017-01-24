@extends('layouts.app')

@section('content')

<h1> Add Category details: </h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div class="row">
	<div class="col col-md-10">
		@foreach($errors->all() as $error)
		<div class="alert alert-danger alert-dismissable fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>danger!</strong> {{$error}}.
		</div>
		@endforeach
		{!!Form::open(['method'=>'POST', 'route' => 'categories.store'], ['class'=>'form-horizontal'])!!}
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
			    	['class' => 'form-control', 'placeholder'=>'Description', 'rows'=>'3']) !!}
			</div>
			@if ($errors->has('description'))
				<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
				<span class="help-block">{{ $errors->first('description') }}</span>
			@endif
		</div>
		<div class="form-group {{$errors->has('advice') ? ' has-error has-feedback' : ''}}">
		    {!! Form::label('advice', 'Advice', ['class'=>'control-label sr-only']) !!}
		    <div class="input-group">
			    <span class="input-group-addon">Advice</span>
			    {!! Form::textarea('advice', Input::old('advice'), 
			    	['class' => 'col-md-6 form-control', 'placeholder'=>'Advice', 'rows'=>'3']) !!}
			</div>
			@if ($errors->has('advice'))
				<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
				<span class="help-block">{{ $errors->first('advice') }}</span>
			@endif
		</div>

		<div class="form-group {{$errors->has('parent_id') ? ' has-error has-feedback' : ''}}">
		    {!! Form::label('parent_id', 'Parent Category', ['class'=>'control-label sr-only']) !!}
		    <div class="input-group">
			    <span class="input-group-addon">Parent Category</span>
			    {!! Form::select('parent_id', $categories->pluck('name','id'), Input::old('parent_id'), 
			    	['class' => 'form-control', 'placeholder'=>'Parent Category']) !!}
			</div>
			@if ($errors->has('parent_id'))
				<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
				<span class="help-block">{{ $errors->first('parent_id') }}</span>
			@endif
		</div>
		{!!Form::submit('Save', ['class'=>'form-controll btn btn-success'])!!}
		{!!Form::close()!!}
	</div>
</div>
@endsection
