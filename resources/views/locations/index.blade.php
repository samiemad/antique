@extends('layouts.app')

@section('content')

<h2 class="well"> All the Locations:
	<a href="{{ route('locations.create') }}" class="btn btn-primary pull-right">Create a new Location</a>
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
				@foreach($locations as $location)
				<tr>
					<td>{{ $location->id }}</td>
					<td>{{ $location->name }}</td>
					<td>{{ $location->main?'Yes':'No' }}</td>
					<td>{{ $location->parent->name??'N/A' }}</td>

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
