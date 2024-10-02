@extends('layouts.app')

@section('content')
    <h1>Add New Monitoring Log</h1>
    <form action="{{ route('logs.store') }}" method="POST">
        @csrf
        <div>
            <label for="activity">Activity:</label>
            <input type="text" name="activity" required>
        </div>
        <div>
            <button type="submit" class="btn btn-success">Create</button>
        </div>
    </form>
@endsection
