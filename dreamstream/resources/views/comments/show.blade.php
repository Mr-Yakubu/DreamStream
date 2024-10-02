@extends('layouts.app')

@section('content')
    <h1>Comment</h1>
    <p>{{ $comment->content }}</p>
    <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endsection
