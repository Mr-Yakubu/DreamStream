@extends('layouts.app')

@section('content')
    <h1>All Recommendations</h1>
    <a href="{{ route('recommendations.create') }}" class="btn btn-primary">Add New Recommendation</a>
    <ul>
        @foreach($recommendations as $recommendation)
            <li>
                {{ $recommendation->title }} - 
                <a href="{{ route('recommendations.show', $recommendation->id) }}">View</a> | 
                <a href="{{ route('recommendations.edit', $recommendation->id) }}">Edit</a> | 
                <form action="{{ route('recommendations.destroy', $recommendation->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
