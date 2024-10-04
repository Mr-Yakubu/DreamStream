@extends('layouts.app')

@section('content')
    <h1>{{ $media->title }}</h1>
    <video width="600" controls>
        <source src="{{ $media->url }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <h3>Comments</h3>
    <ul>
        @foreach ($comments as $comment)
            <li>{{ $comment->content }}</li>
        @endforeach
    </ul>

    <h3>Recommendations</h3>
    <ul>
        @foreach ($recommendations as $recommendation)
            <li>{{ $recommendation->content }}</li>
        @endforeach
    </ul>

    <a href="{{ url('/') }}" class="btn btn-primary">Back to Media</a>
@endsection
