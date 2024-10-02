@extends('layouts.app')

@section('content')
    <h1>Monitoring Log</h1>
    <p>{{ $log->activity }}</p>
    <a href="{{ route('logs.edit', $log->id) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('logs.destroy', $log->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endsection
