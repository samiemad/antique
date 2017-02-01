@extends('layouts.app')

@section('content')

<h2 class="well"> Categories in {{$category->name}}:
	<div class="btn-group pull-right">
		<a href="{{ route('categories.show',$category->id) }}" class="btn btn-success">View</a>
		<a href="{{ route('categories.edit',$category->id) }}" class="btn btn-info">Edit</a>
		<a href="{{ route('categories.create',$category->id) }}" class="btn btn-primary pull-right">Add sub-category</a>
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
					<td>Description</td>
					<td>Advice</td>
					<td>Parent Category</td>
					<td style="width: 170px">Actions</td>
				</tr>
			</thead>
			<tbody>
				@foreach($category->children as $category)
				<tr>
					<td>{{ $category->id }}</td>
					<td>
						<a href={{route('categories.browse',$category->id)}} class="btn btn-default btn-block">
							{{ $category->name }}
						</a>
					</td>
					<td>{{ $category->description }}</td>
					<td>{{ $category->advice }}</td>
					<td>{{ $category->parent->name??'N/A' }}</td>

					<!-- we will also add show, edit, and delete buttons -->
					<td>

							<!-- delete the user (uses the destroy method DESTROY /categories/{id} -->
							{!! Form::open(['route'=>['categories.destroy', $category->id], 'method'=>'delete', 'class'=>'']) !!}
							<div class="btn-group btn-group-sm">
							<!-- show the user (uses the show method found at GET /categories/{id} -->
							<a class="btn btn-sm btn-success" href="{{ route('categories.show', ['id'=>$category->id]) }}">Show</a>

							<!-- edit this user (uses the edit method found at GET /categories/{id}/edit -->
							<a class="btn btn-sm btn-info" href="{{ route('categories.edit', ['id'=>$category->id]) }}">Edit</a>
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
