@extends('layouts.app')

@section('content')

<h1> All the users</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div class="row">
	<div class="col col-md-10">
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
					<td>Actions</td>
				</tr>
			</thead>
			<tbody>
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
						<!-- we will add this later since its a little more complicated than the other two buttons -->

						<!-- edit this user (uses the edit method found at GET /users/{id}/edit -->
						<a class="btn btn-small btn-info" href="{{ route('users.edit', ['id' => $user->id]) }}">Edit</a>

					</td>
				</tr>
			</tbody>
		</table>
		<div class="col">
			<p>name: {{$user->name}}</p>
			<p>email: {{$user->email}}</p>
			<p>username: {{$user->username}}</p>
			<p>phone: {{$user->phone}}</p>
			<p>facebook: {{$user->facebook}}</p>
			<p>google: {{$user->google}}</p>
			<p>points: {{$user->points}}</p>
			<p>cerdit: {{$user->credit}}</p>
			<p>gender: {{$user->gender}}</p>
			<p>date of birth: {{$user->birth}}</p>
			<p>location: {{$user->location->name??'N/A'}}</p>
			<p>referrer: {{$user->referrer->name??'N/A'}}</p>
			<p>created_at: {{$user->created_at}}</p>
			<p>modified_at: {{$user->modified_at}}</p>
			<p>roles:
				<ul>
					@foreach($user->roles as $role)
					<li>{{$role->name}}</li>
					@endforeach
				</ul>
			</p>
			
		</div>
	</div>
</div>
@endsection
