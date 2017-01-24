@extends('layouts.app')

@section('content')

<h1> Edit Category details: </h1>

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
		{!!Form::model($category, ['method'=>'PUT', 'route' => ['categories.update', $category->id]])!!}
		<div class="form-group">
		    {!! Form::label('name', 'Name') !!}
		    {!! Form::text('name', Input::old('name'), ['class' => 'form-control']) !!}
			@if ($errors->has('name'))
				<p class="help-block">{{ $errors->first('name') }}</p>
			@endif
		</div>
		<div class="form-group">
		    {!! Form::label('description', 'Description') !!}
		    {!! Form::textarea('description', Input::old('description'), ['class' => 'form-control']) !!}
			@if ($errors->has('description'))
				<p class="help-block">{{ $errors->first('description') }}</p>
			@endif
		</div>
		<div class="form-group">
		    {!! Form::label('advice', 'Advice') !!}
		    {!! Form::textarea('advice', Input::old('advice'), ['class' => 'form-control']) !!}
			@if ($errors->has('advice'))
				<p class="help-block">{{ $errors->first('advice') }}</p>
			@endif
		</div>
		<div class="form-group">
			{!! Form::label('parent_id', 'Parent Category') !!}
			{!! Form::select('parent_id', $categories->pluck('name','id'), Input::old('parent_id'), ['class' => 'form-control']) !!}
			@if ($errors->has('parent_id'))
			<p class="help-block">{{ $errors->first('parent_id') }}</p>
			@endif
		</div>

		{!!Form::submit('Save', ['class'=>'form-controll btn btn-success'])!!}
		{!!Form::close()!!}
	</div>
</div>
@endsection
