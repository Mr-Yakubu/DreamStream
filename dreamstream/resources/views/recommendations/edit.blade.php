@extends('layouts.app')

@section('content')
    <h1>Edit Recommendation</h1>
    <form action="{{ route('recommendations.update', $recommendation->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" value="{{ $recommendation->title }}" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" required>{{ $recommendation->description }}</textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
