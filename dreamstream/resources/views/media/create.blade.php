@extends('layouts.app')

@section('content')
    <h1>Upload New Media</h1>
    <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" required>
        </div>
        <div>
            <label for="file">File:</label>
            <input type="file" name="file" required>
        </div>
        <div>
            <button type="submit" class="btn btn-success">Upload</button>
        </div>
    </form>
@endsection
