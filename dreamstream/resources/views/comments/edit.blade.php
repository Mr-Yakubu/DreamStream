@extends('layouts.app')

@section('content')
    <h1>Edit Comment</h1>
    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="content">Comment:</label>
            <textarea name="content" required>{{ $comment->content }}</textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
