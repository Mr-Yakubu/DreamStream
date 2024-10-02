@extends('layouts.app')

@section('content')
    <h1>Edit Monitoring Log</h1>
    <form action="{{ route('logs.update', $log->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="activity">Activity:</label>
            <input type="text" name="activity" value="{{ $log->activity }}" required>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
