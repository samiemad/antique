@extends('layouts.app')

@section('content')

<h2 class="well"> Location details: </h2>

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
			<tbody>
				<tr>
					<td class="text-center">ID: </td>
					<td>{{ $location->id }}</td>
				</tr>
				<tr>
					<td class="text-center">Name: </td>
					<td>{{ $location->name }}</td>
				</tr>
				<tr>
					<td class="text-center">Parent location: </td>
					<td>{{ $location->parent->name??'N/A' }}</td>
				</tr>
				<tr>
					<td class="text-center">Public location: </td>
					<td>{{ $location->main?'Yes':'No' }}</td>
				</tr>
				<tr>
					<td class="text-center">Actions: </td>
					<!-- we will also add show, edit, and delete buttons -->
					<td>

						<!-- delete the user (uses the destroy method DESTROY /users/{id} -->
						<!-- we will add this later since its a little more complicated than the other two buttons -->

						<!-- edit this user (uses the edit method found at GET /users/{id}/edit -->
						<a class="btn btn-small btn-info btn-block" href="{{ route('locations.edit', ['id' => $location->id]) }}">Edit</a>

					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
@endsection
