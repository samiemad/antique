@extends('layouts.app')

@section('content')
<h2></h2>
<div class="panel panel-default data-postid="{{ $item->id }}"">
	<div class="panel-heading lead text-capitalize">{{ $item->name }}</div>
	<div class="panel-body">
		<p><h4>{{ $item->description }}</h4></p>

		<div class="row">
			@foreach($item->images as $image)
			<div class="col-md-3">
				<div class="thumbnail">
					<a href="{{ url(Storage::url($image->path)) }}">
						<img src="{{ url(Storage::url($image->path)) }}" alt="Image" style="width:100%">
						<div class="caption">

						</div>
					</a>
				</div>
			</div>
			@endforeach
		</div>
		<hr/>
		<div class="interaction btn-group btn-group-sm">
			<a class="like btn btn-success {{$item->liked?'active':''}}" href="#">{{$item->liked?'Liked':'Like'}}</a>
			<a class="like btn btn-warning {{$item->disliked?'active':''}}" href="#">{{$item->disliked?'Disliked':'Dislike'}}</a>
			@if(Auth::user()==$item->user)
			<a class="edit btn btn-info" href="#">Edit</a>
			<a class="btn btn-danger" href="#">Delete</a>
			@endif
		</div>
		<div class="pull-right btn">
			<div class="label label-default">posted by {{$item->user->name}} on {{$item->created_at}}</div>
		</div>
		<hr/>

		{!! Form::open(['url'=>url('/item/'.$item->id.'/comment'),'class'=>'']) !!}
		<div class="form-group {{$errors->has('text') ? ' has-error has-feedback' : ''}}">
			{!! Form::label('text', 'Comment', ['class'=>'control-label sr-only']) !!}
			<div class="input-group">
				{{-- <span class="input-group-addon">Comment</span> --}}
				{!! Form::text('text', Input::old('text'), 
				['class' => 'form-control', 'placeholder'=>'Comment', 'required']) !!}
				<div class="input-group-btn">
					<button type="submit" class="btn btn-primary">
						Add
					</button>
				</div>
			</div>
			@if ($errors->has('text'))
			<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
			<span class="help-block">{{ $errors->first('text') }}</span>
			@endif
		</div>
		{!! Form::close() !!}

		@foreach($item->comments as $comment)
		<div class="row">
			{{-- <span class="col-md-2">{{$comment->user->name}}:</span> --}}
			<div class="col-md-10">{{$comment->text}}</div>
			<div class="col-md-2">
				<div class=" pull-right btn">
					<div class="label label-default">
						comment by {{$comment->user->name}} on {{$comment->created_at}}
					</div>
				</div>
			</div>
		</div>
		@if($loop->remaining)
		<hr>
		@endif
		@endforeach
	</div>
</div>
@endsection
