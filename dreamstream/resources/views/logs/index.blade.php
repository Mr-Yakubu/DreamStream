@extends('layouts.app')

@section('content')
    <h1>All Monitoring Logs</h1>
    <ul>
        @foreach($logs as $log)
            <li>
                {{ $log->activity }} - 
                <a href="{{ route('logs.show', $log->id) }}">View</a> | 
                <a href="{{ route('logs.edit', $log->id) }}">Edit</a> | 
                <form action="{{ route('logs.destroy', $log->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
