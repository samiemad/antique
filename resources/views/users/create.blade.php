@extends('layouts.app')

@section('content')

<h2 class="well"> Create a new user: </h2>

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
			<strong>Error: </strong> {{$error}}.
		</div>
		@endforeach
		{!!Form::open(['method'=>'POST', 'route' => ['users.store']])!!}
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
		<div class="form-group {{$errors->has('email') ? ' has-error has-feedback' : ''}}">
			{!! Form::label('email', 'Email', ['class'=>'control-label sr-only']) !!}
			<div class="input-group">
				<span class="input-group-addon">Email</span>
				{!! Form::email('email', Input::old('email'), 
					['class' => 'form-control', 'placeholder'=>'Email']) !!}
			</div>
			@if ($errors->has('email'))
				<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
				<span class="help-block">{{ $errors->first('email') }}</span>
			@endif
		</div>
		<div class="form-group {{$errors->has('password') ? ' has-error has-feedback' : ''}}">
		    {!! Form::label('password', 'Password', ['class'=>'control-label sr-only']) !!}
		    <div class="input-group">
			    <span class="input-group-addon">Password</span>
			    {!! Form::password('password',  
			    	['class' => 'form-control', 'placeholder'=>'Password']) !!}
			</div>
			@if ($errors->has('password'))
				<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
				<span class="help-block">{{ $errors->first('password') }}</span>
			@endif
		</div>
		<div class="form-group {{$errors->has('password_confirmation') ? ' has-error has-feedback' : ''}}">
		    {!! Form::label('password_confirmation', 'Confirm Password', ['class'=>'control-label sr-only']) !!}
		    <div class="input-group">
			    <span class="input-group-addon">Confirm Password</span>
			    {!! Form::password('password_confirmation',
			    	['class' => 'form-control', 'placeholder'=>'Confirm Password']) !!}
			</div>
			@if ($errors->has('password_confirmation'))
				<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
				<span class="help-block">{{ $errors->first('password_confirmation') }}</span>
			@endif
		</div>
		<div class="form-group {{$errors->has('username') ? ' has-error has-feedback' : ''}}">
			{!! Form::label('username', 'Username', ['class'=>'control-label sr-only']) !!}
			<div class="input-group">
				<span class="input-group-addon">Username</span>
				{!! Form::text('username', Input::old('username'), 
					['class' => 'form-control', 'placeholder'=>'Username']) !!}
			</div>
			@if ($errors->has('username'))
				<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
				<span class="help-block">{{ $errors->first('username') }}</span>
			@endif
		</div>
		<div class="form-group {{$errors->has('phone') ? ' has-error has-feedback' : ''}}">
			{!! Form::label('phone', 'Phone', ['class'=>'control-label sr-only']) !!}
			<div class="input-group">
				<span class="input-group-addon">Phone</span>
				{!! Form::text('phone', Input::old('phone'), 
					['class' => 'form-control', 'placeholder'=>'Phone']) !!}
			</div>
			@if ($errors->has('phone'))
				<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
				<span class="help-block">{{ $errors->first('phone') }}</span>
			@endif
		</div>
		<div class="form-group {{$errors->has('facebook') ? ' has-error has-feedback' : ''}}">
			{!! Form::label('facebook', 'Facebook ID', ['class'=>'control-label sr-only']) !!}
			<div class="input-group">
				<span class="input-group-addon">Facebook ID</span>
				{!! Form::text('facebook', Input::old('facebook'), 
					['class' => 'form-control', 'placeholder'=>'Facebook ID']) !!}
			</div>
			@if ($errors->has('facebook'))
				<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
				<span class="help-block">{{ $errors->first('facebook') }}</span>
			@endif
		</div>
		<div class="form-group {{$errors->has('google') ? ' has-error has-feedback' : ''}}">
			{!! Form::label('google', 'Google ID', ['class'=>'control-label sr-only']) !!}
			<div class="input-group">
				<span class="input-group-addon">Google ID</span>
				{!! Form::text('google', Input::old('google'), 
					['class' => 'form-control', 'placeholder'=>'Google ID']) !!}
			</div>
			@if ($errors->has('google'))
				<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
				<span class="help-block">{{ $errors->first('google') }}</span>
			@endif
		</div>
		<div class="form-group {{$errors->has('points') ? ' has-error has-feedback' : ''}}">
			{!! Form::label('points', 'Points', ['class'=>'control-label sr-only']) !!}
			<div class="input-group">
				<span class="input-group-addon">Points</span>
				{!! Form::number('points', Input::old('points'), 
					['class' => 'form-control', 'placeholder'=>'Points']) !!}
			</div>
			@if ($errors->has('points'))
				<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
				<span class="help-block">{{ $errors->first('points') }}</span>
			@endif
		</div>
		<div class="form-group {{$errors->has('credit') ? ' has-error has-feedback' : ''}}">
			{!! Form::label('credit', 'Credit', ['class'=>'control-label sr-only']) !!}
			<div class="input-group">
				<span class="input-group-addon">Credit</span>
				{!! Form::number('credit', Input::old('credit'), 
					['class' => 'form-control', 'placeholder'=>'Credit']) !!}
			</div>
			@if ($errors->has('credit'))
				<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
				<span class="help-block">{{ $errors->first('credit') }}</span>
			@endif
		</div>
		<div class="form-group {{$errors->has('gender') ? ' has-error has-feedback' : ''}}">
			{!! Form::label('gender', 'Gender', ['class'=>'control-label sr-only']) !!}
			<div class="input-group">
				<span class="input-group-addon">Gender</span>
				{!! Form::select('gender', ['unspecified'=>'Unspecified', 'male'=>'Male', 'female'=>'Female'],
					Input::old('gender'), ['class' => 'form-control']) !!}
			</div>
			@if ($errors->has('gender'))
				<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
				<span class="help-block">{{ $errors->first('gender') }}</span>
			@endif
		</div>
		<div class="form-group {{$errors->has('birth') ? ' has-error has-feedback' : ''}}">
		    {!! Form::label('birth', 'Birth', ['class'=>'control-label sr-only']) !!}
		    <div class="input-group">
			    <span class="input-group-addon">Birth</span>
			    {!! Form::date('birth', Input::old('birth'), 
			    	['class' => 'form-control', 'placeholder'=>'1990-01-01']) !!}
			</div>
			@if ($errors->has('birth'))
				<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
				<span class="help-block">{{ $errors->first('birth') }}</span>
			@endif
		</div>
		<div class="form-group {{$errors->has('location') ? ' has-error has-feedback' : ''}}">
		    {!! Form::label('location', 'Location', ['class'=>'control-label sr-only']) !!}
		    <div class="input-group">
			    <span class="input-group-addon">Location</span>
			    {!! Form::select('location',  $locations->pluck('name','id'),
			    	Input::old('location'), ['class' => 'form-control']) !!}
			</div>
			@if ($errors->has('location'))
				<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
				<span class="help-block">{{ $errors->first('location') }}</span>
			@endif
		</div>
		<div class="form-group {{$errors->has('referrer') ? ' has-error has-feedback' : ''}}">
		    {!! Form::label('referrer', 'Referrer', ['class'=>'control-label sr-only']) !!}
		    <div class="input-group">
			    <span class="input-group-addon">Referrer</span>
			    {!! Form::select('referrer', $users->pluck('name','id')->prepend('N/A',''),
			    	Input::old('referrer'), ['class' => 'form-control']) !!}
			</div>
			@if ($errors->has('referrer'))
				<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
				<span class="help-block">{{ $errors->first('referrer') }}</span>
			@endif
		</div>
		<div class="form-group {{$errors->has('roles') ? ' has-error has-feedback' : ''}}">
		    {!! Form::label('roles', 'Roles', ['class'=>'control-label sr-only']) !!}
		    <div class="input-group">
			    <span class="input-group-addon">Roles:</span>
				@foreach($roles as $role)
					<label for="roles[{{$role->id}}]" class="checkbox-inline btn btn-default">
					{!! Form::checkbox('roles['.$role->id.']', $role->id, false, ['class' => 'form-control'] ) !!}
					{{$role->name}}</label>
				@endforeach
			</div>
			@if ($errors->has('roles'))
				<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
				<span class="help-block">{{ $errors->first('roles') }}</span>
			@endif
		</div>

		{!!Form::submit('Add', ['class'=>'form-controll btn btn-success'])!!}
		{!!Form::close()!!}
	</div>
</div>
@endsection
