@extends('layouts.app')

@section('content')
<h2 class="well">
	Dashboard
	<a href="{{ url('/publish') }}" class="btn btn-primary pull-right">Publish a new item for sale</a>
</h2>
<div class="panel-group">
	@foreach($items as $item)
	<div class="panel panel-default data-postid="{{ $item->id }}"">
		<div class="panel-heading"><strong>{{ $item->name }}</strong></div>
		<div class="panel-body">
			<p>{{ $item->description }}</p>
		</div>
		<div class="panel-footer">
			<div class="interaction btn-group btn-group-sm">
				<a class="like btn btn-success {{$item->liked?'active':''}}" href="#">{{$item->liked?'Liked':'Like'}}</a>
				<a class="like btn btn-warning {{$item->disliked?'active':''}}" href="#">{{$item->disliked?'Disliked':'Dislike'}}</a>
				<a href="{{url('/item/'.$item->id)}}" class="like btn btn-default">Read more..</a>
				@if(Auth::user()==$item->user)
				<a class="edit btn btn-info" href="#">Edit</a>
				<a class="btn btn-danger" href="#">Delete</a>
				@endif
			</div>
			<div class="info pull-right btn">
				<div class="label label-default">posted by {{$item->user->name??'Deleted User'}} on {{$item->created_at}}</div>
			</div>
		</div>
	</div>
	@endforeach
</div>
{{ $items->links() }}
@endsection
