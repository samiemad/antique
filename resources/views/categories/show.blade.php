@extends('layouts.app')

@section('content')

<h1> Category details </h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div class="row">
	<div class="col col-md-12">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<td>ID</td>
					<td>Name</td>
					<td>Description</td>
					<td>Advice</td>
					<td>Actions</td>
				</tr>
			</thead>
			<tbody>
				<tr>
						<td>{{ $category->id }}</td>
					<td>{{ $category->name }}</td>
					<td>{{ $category->description }}</td>
					<td>{{ $category->advice }}</td>

					<!-- we will also add show, edit, and delete buttons -->
					<td>

						<!-- delete the user (uses the destroy method DESTROY /users/{id} -->
						<!-- we will add this later since its a little more complicated than the other two buttons -->

						<!-- edit this user (uses the edit method found at GET /users/{id}/edit -->
						<a class="btn btn-small btn-info" href="{{ route('categories.edit', ['id' => $category->id]) }}">Edit</a>

					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
@endsection
