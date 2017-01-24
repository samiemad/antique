@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col col-md-2 col-md-offset-5">
		<a href="{{ route('categories.create') }}" class="btn btn-primary"><strong>Create a new Category</strong></a>
	</div>
</div>

<h1> All the Categories</h1>

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
					<td>Parent Category</td>
					<td>Actions</td>
				</tr>
			</thead>
			<tbody>
				@foreach($categories as $category)
				<tr>
					<td>{{ $category->id }}</td>
					<td>{{ $category->name }}</td>
					<td>{{ $category->description }}</td>
					<td>{{ $category->advice }}</td>
					<td>{{ $category->parent->name??'N/A' }}</td>

					<!-- we will also add show, edit, and delete buttons -->
					<td>

						<!-- delete the user (uses the destroy method DESTROY /categories/{id} -->
						{!! Form::open(['route'=>['categories.destroy', $category->id], 'method'=>'delete', 'class'=>'pull-right']) !!}
						{!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
						{!! Form::close() !!}

						<!-- show the user (uses the show method found at GET /categories/{id} -->
						<a class="btn btn-small btn-success" href="{{ route('categories.show', ['id'=>$category->id]) }}">Show</a>

						<!-- edit this user (uses the edit method found at GET /categories/{id}/edit -->
						<a class="btn btn-small btn-info" href="{{ route('categories.edit', ['id'=>$category->id]) }}">Edit</a>

					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection
