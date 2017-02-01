@extends('layouts.app')

@section('content')

<h2 class="well"> All the users
	<a href="{{ route('users.create') }}" class="btn btn-primary pull-right">Create a new User</a>
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
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<td>ID</td>
					<td>Name</td>
					<td>Email</td>
					<td>Username</td>
					<td>phone</td>
					<td>Points</td>
					<td>Credit</td>
					<td>Gender</td>
					<td>Birth</td>
					<td>Referrer</td>
					<td>Location</td>
					<td style="width: 170px">Actions</td>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
				<tr>
					<td>{{ $user->id }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->username }}</td>
					<td>{{ $user->phone }}</td>
					<td>{{ $user->points }}</td>
					<td>{{ $user->credit }}</td>
					<td>{{ $user->gender }}</td>
					<td>{{ $user->birth }}</td>
					<td>{{ $user->referrer->name??'N/A' }}</td>
					<td>{{ $user->location->name??'N/A' }}</td>

					<!-- we will also add show, edit, and delete buttons -->
					<td>

						<!-- delete the user (uses the destroy method DESTROY /users/{id} -->
						{!! Form::open(['route'=>['users.destroy', $user->id], 'method'=>'delete', 'class'=>'']) !!}
						<div class="btn-group btn-group-sm">
						<!-- show the user (uses the show method found at GET /users/{id} -->
						<a class="btn btn-sm btn-success" href="{{ route('users.show', ['id'=>$user->id]) }}">Show</a>

						<!-- edit this user (uses the edit method found at GET /users/{id}/edit -->
						<a class="btn btn-sm btn-info" href="{{ route('users.edit', ['id'=>$user->id]) }}">Edit</a>
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
