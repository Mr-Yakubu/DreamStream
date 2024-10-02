@extends('layouts.app')

@section('content')
    <h1>{{ $media->title }}</h1>
    <div>
        <p><strong>Uploaded:</strong> {{ $media->created_at->toFormattedDateString() }}</p>
        <video src="{{ asset('storage/' . $media->file) }}" controls></video>
    </div>
    <a href="{{ route('media.edit', $media->id) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('media.destroy', $media->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endsection
