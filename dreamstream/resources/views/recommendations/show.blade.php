@extends('layouts.app')

@section('content')
    <h1>{{ $recommendation->title }}</h1>
    <p>{{ $recommendation->description }}</p>
    <a href="{{ route('recommendations.edit', $recommendation->id) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('recommendations.destroy', $recommendation->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endsection
