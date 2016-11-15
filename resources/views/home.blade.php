@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
            Dashboard
            <a href="{{ url('/publish') }}" class="btn btn-primary publish">Publish a new item for sale</a>
            </div>

            <div class="panel-body items">
                @foreach($items as $item)
                <a href="{{url('/item/'.$item->id)}}">
                <article class="item" data-postid="{{ $item->id }}">
                    <h4 class="header">{{ $item->name }}</h4>
                    <p>{{ $item->description }}</p>
                    <div class="info">
                        posted by {{$item->user->name}} on {{$item->created_at}}
                    </div>
                    <div class="interaction">
                        <a href="#" class="like">{{$item->liked?'Liked':'Like'}}</a>
                        | <a href="#" class="like">{{$item->disliked?'Disliked':'Dislike'}}</a>
                        @if(Auth::user()==$item->user)
                        | <a href="#" class="edit">Edit</a>
                        | <a href="#">Delete</a>
                        @endif
                    </div>
                </article>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
