@extends('layouts.app')

@section('content')
    <h1>All Parental Controls</h1>
    <a href="{{ route('parental-controls.create') }}" class="btn btn-primary">Add New Parental Control</a>
    <ul>
        @foreach($parentalControls as $control)
            <li>
                {{ $control->setting }} - 
                <a href="{{ route('parental-controls.show', $control->id) }}">View</a> | 
                <a href="{{ route('parental-controls.edit', $control->id) }}">Edit</a> | 
                <form action="{{ route('parental-controls.destroy', $control->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </li>
        @endforeach
