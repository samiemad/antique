@extends('layouts.app')

@section('content')

<h1> Create a user</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div class="row">
	<div class="col col-md-10">

		<!-- if there are creation errors, they will show here -->
		{!! Html::ul($errors->all()) !!}

		{!! Form::open(['route' => 'users.store']) !!}

		 <div class="form-group">
	        {!! Form::label('name', 'Name', ['class' => 'col-md-2']) !!}
	        {!! Form::text('name', '', array('class' => 'form-control col-md-4')) !!}
	    </div>

		 <div class="form-group">
	        {!! Form::label('email', 'Email') !!}
	        {!! Form::email('email', '', array('class' => 'form-control')) !!}
	    </div>

		 <div class="form-group">
	        {!! Form::label('password', 'Password') !!}
	        {!! Form::password('password', '', array('class' => 'form-control')) !!}
	    </div>

		 <div class="form-group">
	        {!! Form::label('username', 'Username') !!}
	        {!! Form::text('username', '', array('class' => 'form-control')) !!}
	    </div>

		 <div class="form-group">
	        {!! Form::label('phone', 'phone') !!}
	        {!! Form::number('phone', '', array('class' => 'form-control')) !!}
	    </div>



		{!! Form::close() !!}

	</div>
</div>
@endsection
