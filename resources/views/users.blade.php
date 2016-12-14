@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="row">
            <div class="col-md-8">
                @foreach($users as $user)
                <article class="item" data-postid="{{ $user->id }}">
                    <h4 class="header">{{ $user->name }}</h4>
                    <p>{{ $user->email }}</p>
                    @foreach($user->roles as $role)
                        <p>{{ $role->name}}</p>
                    @endforeach
                </article>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
