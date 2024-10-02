@extends('layouts.app')

@section('content')
    <h1>All Media</h1>
    <a href="{{ route('media.create') }}" class="btn btn-primary">Upload New Media</a>
    <ul>
        @foreach($media as $item)
            <li>
                {{ $item->title }} - 
                <a href="{{ route('media.show', $item->id) }}">View</a> | 
                <a href="{{ route('media.edit', $item->id) }}">Edit</a> | 
                <form action="{{ route('media.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
