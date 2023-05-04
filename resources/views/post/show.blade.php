@extends('layouts.main')
@section('content')
    <div>
        <div>{{ $post->id }}. {{ $post->title }}</div>
        <div>{{ $post->content }}</div>
    </div>
    <div>
        <a href="{{ route('post.edit', $post->id) }}">Update</a>
    </div>
    <div>
        <form action="{{ route('post.destroy', $post->id) }}" method="post">
            @csrf
            @method('delete')
            <input type="submit" value="Delete">
        </form>
    </div>
    <div>
        <a href="{{ route('post.index') }}">Back</a>
    </div>
@endsection
