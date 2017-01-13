@extends('layouts.app')

@section('content')

<h1> All the users</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div class="row">
	<div class="col col-md-10">
		@foreach($errors->all() as $error)
			<div class="alert"> Error: {{$error}} </div>
		@endforeach
		{!!Form::model($user, ['method'=>'PUT', 'route' => ['users.update', $user->id]])!!}
		<div class="form-group">
			{!! Form::label('name', 'Name') !!}
			{!! Form::text('name', Input::old('name'), ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('email', 'E-mail') !!}
			{!! Form::email('email', Input::old('email'), ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('username', 'Username') !!}
			{!! Form::text('username', Input::old('username'), ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('phone', 'Phone No.') !!}
			{!! Form::number('phone', Input::old('phone'), ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('facebook', 'Facebook Account') !!}
			{!! Form::text('facebook', Input::old('facebook'), ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('google', 'Google Account') !!}
			{!! Form::text('google', Input::old('google'), ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('points', 'Points') !!}
			{!! Form::number('points', Input::old('points'), ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('credit', 'Credit') !!}
			{!! Form::number('credit', Input::old('credit'), ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('gender', 'Gender') !!}
			{!! Form::select('gender',['unspecified'=>'Unspecified', 'male'=>'Male', 'female'=>'Female'], 
				Input::old('gender'), ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('birth', 'Date of Birth') !!}
			{!! Form::date('birth', Input::old('birth'), ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('location', 'Location') !!}
			{!! Form::select('location', $locations->pluck('name','id'),
				Input::old('location'), ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('referrer', 'Referrer') !!}
			{!! Form::select('referrer', $users->except($user->id)->pluck('name','id')->prepend('N/A',''),
				Input::old('referrer'), ['class' => 'form-control']) !!}
		</div>
		<p>roles:</p>
 			@foreach($roles as $role)
				{!! Form::label('roles['.$role->id.']', $role->name) !!}
 				{!! Form::checkbox('roles['.$role->id.']', $role->id, $user->hasRole($role) , ['class' => 'form-control'] ) !!}
 			@endforeach
		{!!Form::submit('Save')!!}
		{!!Form::close()!!}
	</div>
</div>
@endsection
