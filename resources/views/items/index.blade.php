@extends('layouts.app')

@section('content')
<h2 class="well">
	Dashboard
	<a href="{{ route('items.create') }}" class="btn btn-primary pull-right">Publish a new item for sale</a>
</h2>
<div class="panel-group col-md-8 col-md-offset-2">
<div class="row">
	@foreach($items as $item)
	<div class="col-md-6 panel panel-default"">
		<div class="panel-heading"><strong>{{ $item->name }}</strong>
			<div class="pull-right">
				<div class="label label-success">{{$item->category->name??'Deleted Category'}}</div>
				<small>in</small>
				<div class="label label-info">{{$item->location->name??'Deleted Location'}}</div>
			</div>
		</div>
		<div class="panel-body">
			<pre>{{ $item->description }}</pre>
		</div>
		<div class="info pull-right btn">
			<div class="label label-default">posted by {{$item->user->name??'Deleted User'}} on {{$item->created_at}}</div>
		</div>
		<div class="panel-footer">
			{!! Form::open(['route'=>['items.destroy',$item->id], 'method'=>'delete', 'class'=>'form-inline']) !!}
			<div class="interaction btn-group btn-group-sm" data-itemid="{{ $item->id }}">
				<a class="like btn btn-success {{$item->liked?'active':''}}" href="like">{{$item->liked?'Liked':'Like'}}</a>
				<a class="like btn btn-warning {{$item->disliked?'active':''}}" href="dislike">{{$item->disliked?'Disliked':'Dislike'}}</a>
				<a href="{{ route('items.show',$item->id) }}" class="btn btn-default">Read more..</a>
				@if(Auth::user()==$item->user)
				<a class="edit btn btn-info" href="{{ route('items.edit', $item->id) }}">Edit</a>
				{!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
				@endif
			</div>
			{!! Form::close() !!}
		</div>
	</div>
	</div>
	@endforeach
	{{ $items->links() }}
	</div>
</div>

@endsection
