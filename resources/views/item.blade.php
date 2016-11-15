@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">{{ $item->name }}</div>

            <div class="panel-body">
                <article class="item" data-postid="{{ $item->id }}">
                    <h4>
                        {{ $item->name }}
                    </h4>
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
            </div>
            <hr>
            <div class="row">
                @foreach($item->images as $image)
                <img src="{{ url(Storage::url($image->path)) }}" height="100" width="100">
                @endforeach
            </div>
            <div class="row">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/item/'.$item->id.'/upload') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                        <label for="image" class="col-md-2 control-label">Image</label>

                        <div class="col-md-6">
                            <input id="image" type="file" class="form-control" name="image" }}" required>

                            @if ($errors->has('image'))
                            <span class="help-block">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">
                                Add
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <hr>
            <div class="row">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/item/'.$item->id.'/comment') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                    <div class="col-md-8 col-md-offset-1">
                        <input id="text" type="text" class="form-control" name="text" }}" required>

                        @if ($errors->has('text'))
                        <span class="help-block">
                            <strong>{{ $errors->first('text') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">
                            Comment
                        </button>
                    </div>
                </div>
            </form>
            @foreach($item->comments as $comment)
                <div class="col-md-offset-1 col-md-10">
                <p>
                    <span class="col-md-2">{{$comment->user->name}}:</span>
                    <span class="col-md-8">{{$comment->text}}</span>
                    <div class="info col-md-8">
                        comment by {{$comment->user->name}} on {{$comment->created_at}}
                    </div>
                </p>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
