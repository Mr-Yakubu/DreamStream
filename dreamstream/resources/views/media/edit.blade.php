@extends('layouts.app')

@section('content')
    <h1>Edit Media: {{ $media->title }}</h1>
    <form action="{{ route('media.update', $media->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" value="{{ $media->title }}" required>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
