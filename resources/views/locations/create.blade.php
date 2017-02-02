@extends('layouts.app')

@section('content')

<h2 class="well"> Add location details: </h2>

<!-- will be used to show any messages -->
@if (Session::has('message'))
<div class="alert alert-info alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{Session::get('message')}}
</div>
@endif

<div class="row">
	<div class="col col-md-10">
		@foreach($errors->all() as $error)
		<div class="alert alert-danger alert-dismissable fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>danger!</strong> {{$error}}.
		</div>
		@endforeach
		{!!Form::open(['method'=>'POST', 'route' => 'locations.store'], ['class'=>''])!!}
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
		
		<div class="form-group {{$errors->has('parent_id') ? ' has-error has-feedback' : ''}}">
		    {!! Form::label('parent_id', 'Parent location', ['class'=>'control-label sr-only']) !!}
		    <div class="input-group">
			    <span class="input-group-addon">Parent location</span>
			    {!! Form::select('parent_id', $locations->pluck('name','id'), $id??Input::old('parent_id'), 
			    	['class' => 'form-control', 'placeholder'=>'Parent location']) !!}
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
