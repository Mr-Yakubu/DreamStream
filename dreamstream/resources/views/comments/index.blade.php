@extends('layouts.app')

@section('content')
    <h1>All Comments</h1>
    <a href="{{ route('comments.create') }}" class="btn btn-primary">Add New Comment</a>
    <ul>
        @foreach($comments as $comment)
            <li>
                {{ $comment->content }} - 
                <a href="{{ route('comments.show', $comment->id) }}">View</a> | 
                <a href="{{ route('comments.edit', $comment->id) }}">Edit</a> | 
                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
