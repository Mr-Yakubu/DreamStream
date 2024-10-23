@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Filtered Videos</h1>
    @if($filteredVideos && count($filteredVideos) > 0)
        <ul>
            @foreach($filteredVideos as $video)
                <li>
                    <video width="320" height="240" controls>
                        <source src="{{ asset('filtered/' . basename($video)) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </li>
            @endforeach
        </ul>
    @else
        <p>No filtered videos available.</p>
    @endif
</div>
@endsection
