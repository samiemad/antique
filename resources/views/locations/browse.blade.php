@extends('layouts.app')

@section('content')

<h2 class="well"> Locations in {{$location->name}}:
	<div class="btn-group pull-right">
	@if($location->parent!=null)
		<a href="{{ route('locations.browse',$location->parent_id) }}" class="btn btn-default">Up</a>
	@endif
		<a href="{{ route('locations.show',$location->id) }}" class="btn btn-success">View</a>
		<a href="{{ route('locations.edit',$location->id) }}" class="btn btn-info">Edit</a>
		<a href="{{ route('locations.create',$location->id) }}" class="btn btn-primary pull-right">Add sub-location</a>
	</div>
</h2>

<!-- will be used to show any messages -->
@if (Session::has('message'))
<div class="alert alert-info alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{Session::get('message')}}
</div>
@endif

<div class="row">
	<div class="col col-md-12">
		<table class="table table-striped table-bordered table-condenced">
			<thead class="text-center">
				<tr>
					<td>ID</td>
					<td>Name</td>
					<td>Parent location</td>
					<td>Public location</td>
					<td style="width: 170px">Actions</td>
				</tr>
			</thead>
			<tbody>
				@foreach($location->children as $location)
				<tr>
					<td>{{ $location->id }}</td>
					<td>
						<a href={{route('locations.browse',$location->id)}} class="btn btn-default btn-block">
							{{ $location->name }}
						</a>
					</td>
					<td>{{ $location->parent->name??'N/A' }}</td>
					<td>{{ $location->main?'Yes':'No' }}</td>

					<!-- we will also add show, edit, and delete buttons -->
					<td>

							<!-- delete the user (uses the destroy method DESTROY /locations/{id} -->
							{!! Form::open(['route'=>['locations.destroy', $location->id], 'method'=>'delete', 'class'=>'']) !!}
							<div class="btn-group btn-group-sm">
							<!-- show the user (uses the show method found at GET /locations/{id} -->
							<a class="btn btn-sm btn-success" href="{{ route('locations.show', ['id'=>$location->id]) }}">Show</a>

							<!-- edit this user (uses the edit method found at GET /locations/{id}/edit -->
							<a class="btn btn-sm btn-info" href="{{ route('locations.edit', ['id'=>$location->id]) }}">Edit</a>
							{!! Form::submit('Delete', ['class'=>'btn btn-sm btn-danger']) !!}
							</div>
							{!! Form::close() !!}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection
