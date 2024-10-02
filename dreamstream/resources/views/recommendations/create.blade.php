@extends('layouts.app')

@section('content')
    <h1>Add New Recommendation</h1>
    <form action="{{ route('recommendations.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" required></textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-success">Create</button>
        </div>
    </form>
@endsection
