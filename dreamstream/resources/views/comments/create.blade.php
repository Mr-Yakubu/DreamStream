@extends('layouts.app')

@section('content')
    <h1>Add New Comment</h1>
    <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <div>
            <label for="content">Comment:</label>
            <textarea name="content" required></textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-success">Post</button>
        </div>
    </form>
@endsection
