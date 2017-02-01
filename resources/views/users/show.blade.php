@extends('layouts.app')

@section('content')

<h2 class="well"> Category details: </h2>

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
					<td>{{ $user->id }}</td>
				</tr>
				<tr>
					<td class="text-center">Name: </td>
					<td>{{ $user->name }}</td>
				</tr>
				<tr>
					<td class="text-center">Email: </td>
					<td>{{ $user->email }}</td>
				</tr>
				<tr>
					<td class="text-center">Username: </td>
					<td>{{ $user->username }}</td>
				</tr>
				<tr>
					<td class="text-center">Phone: </td>
					<td>{{ $user->phone }}</td>
				</tr>
				<tr>
					<td class="text-center">Facebook ID: </td>
					<td>{{ $user->facebook }}</td>
				</tr>
				<tr>
					<td class="text-center">Google ID: </td>
					<td>{{ $user->google }}</td>
				</tr>

				<tr>
					<td class="text-center">Points: </td>
					<td>{{ $user->points }}</td>
				</tr>
				<tr>
					<td class="text-center">Credit: </td>
					<td>{{ $user->credit }}</td>
				</tr>
				<tr>
					<td class="text-center">Gender: </td>
					<td>{{ $user->gender }}</td>
				</tr>
				<tr>
					<td class="text-center">Birth: </td>
					<td>{{ $user->birth }}</td>
				</tr>
				<tr>
					<td class="text-center">Referrer: </td>
					<td>{{ $user->referrer->name??'N/A' }}</td>
				</tr>
				<tr>
					<td class="text-center">Location: </td>
					<td>{{ $user->location->name??'N/A' }}</td>
				</tr>
				<tr>
					<td class="text-center">Created at: </td>
					<td>{{ $user->created_at }}</td>
				</tr>
				<tr>
					<td class="text-center">Modified at: </td>
					<td>{{ $user->modified_at }}</td>
				</tr>
				<tr>
					<td class="text-center">Roles: </td>
					<td>
					@foreach($user->roles as $role)
						<span class="badge">{{$role->name}}</span>
					@endforeach
					</td>
				</tr>
				<tr>
					<td class="text-center">Actions:</td>
					<!-- we will also add show, edit, and delete buttons -->
					<td>

						<!-- delete the user (uses the destroy method DESTROY /users/{id} -->
						<!-- we will add this later since its a little more complicated than the other two buttons -->

						<!-- edit this user (uses the edit method found at GET /users/{id}/edit -->
						<a class="btn btn-small btn-block btn-info" href="{{ route('users.edit', ['id' => $user->id]) }}">Edit</a>

					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
@endsection
