@extends('layouts.app')

@section('content')
<h2></h2>
<div class="col-md-8 col-md-offset-2">
	<div class="panel panel-default"">
		<div class="panel-heading lead text-capitalize">{{ $item->name }}
			<div class="pull-right">
				<div class="label label-success">{{$item->category->name??'Deleted Category'}}</div>
				<small>in</small>
				<div class="label label-info">{{$item->location->name??'Deleted Location'}}</div>
			</div>
		</div>
		<div class="panel-body">
			<pre><h4>{{ $item->description }}</h4></pre>

			<div class="row">
				@foreach($item->images as $image)
				<div class="col-md-3">
					<div class="thumbnail" style="height:250px">
						<a href="{{ url(Storage::url($image->path)) }}">
							<img src="{{ url(Storage::url($image->path)) }}" alt="Image" style=" max-height:240px;">
							<div class="caption">

							</div>
						</a>
					</div>
				</div>
				@endforeach
			</div>
			<hr/>
			<div class="btn-group">
				{!! Form::open(['route'=>['items.destroy',$item->id], 'method'=>'delete', 'class'=>'form-inline']) !!}
				<div class="interaction btn-group btn-group-sm" data-itemid="{{ $item->id }}">
					<a class="like btn btn-success {{$item->liked?'active':''}}" href="like">
						<span>{{$item->liked?'Liked':'Like'}}</span>
						<span class="badge"> {{$item->numLikes}} </span>
					</a>
					<a class="like btn btn-warning {{$item->disliked?'active':''}}" href="dislike">
						<span class="badge"> {{$item->numDislikes}} </span>
						<span>{{$item->disliked?'Disliked':'Dislike'}}</span>
					</a>
				</div>
				{!! Form::open(['route'=>['items.destroy',$item->id], 'method'=>'delete', 'class'=>'form-inline']) !!}
				<div class="btn-group btn-group-sm"> 
					@if(Auth::user()==$item->user)
					<a class="edit btn btn-info" href="{{ route('items.edit', $item->id) }}">Edit</a>
					{!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
					@endif
				</div>
				{!! Form::close() !!}
			</div>
			<div class="pull-right btn">
				<div class="label label-default">posted by {{$item->user->name??'Deleted User'}} on {{$item->created_at}}</div>
			</div>
			<hr/>

			{!! Form::open(['route'=>['items.addComment',$item->id],'class'=>'']) !!}
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
							comment by {{$comment->user->name??'Deleted User'}} on {{$comment->created_at}}
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
</div>
@endsection
