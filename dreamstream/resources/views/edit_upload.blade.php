@extends('layouts.app') <!-- Assuming you're using a layout -->

@section('content')
<div class="container">
    <h2>Upload or Edit Video</h2>

    <!-- Channel Name -->
    <div class="form-group">
        <label for="channel_name">Channel Name:</label>
        <p id="channel_name">{{ auth()->user()->username }}</p> <!-- Displaying the username -->
    </div>

    <!-- Video Preview and Video Details Section -->
    <div class="d-flex" style="position: relative;">
        <!-- Video Preview -->
        <div class="video-preview">
            <h4>Video Preview</h4>
            @if (isset($video)) <!-- If editing an existing video -->
                <div class="video-player">
                    <video controls>
                        <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            @else
                <p>No video uploaded yet.</p>
            @endif
        </div>

        <!-- Video Upload/Edit Form -->
        <div class="video-details" style="position: absolute; top: 50%; right: -300px; transform: translateY(-50%);">
            <form action="{{ isset($video) ? route('videos.update', $video->id) : route('videos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($video))
                    @method('PUT') <!-- For editing -->
                @endif

                <!-- Description -->
                <div class="form-group mb-3">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" required>{{ isset($video) ? $video->description : old('description') }}</textarea>
                </div>

                <!-- Title -->
                <div class="form-group mb-3">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ isset($video) ? $video->title : old('title') }}" required>
                </div>

                <!-- Upload Video Section -->
                <div class="form-group text-center mb-4">
                    <label for="video_file" class="d-block text-center">Upload Video:</label>
                    <input type="file" id="video_file_input" name="video_file" style="display: none;" {{ isset($video) ? '' : 'required' }}>
                    <div class="d-flex justify-content-center mt-2">
                        <button type="button" class="btn btn-file-custom" onclick="document.getElementById('video_file_input').click();">Choose File</button>
                        <button type="submit" class="btn btn-custom ms-2">{{ isset($video) ? 'Update Video' : 'Upload Video' }}</button>
                        @if (!isset($video)) <!-- Show only for new video uploads -->
                            <button type="submit" name="publish" value="1" class="btn btn-custom ms-2">Publish Video</button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- My Videos Section -->
    <div class="my-videos mt-5">
        <h3>My Videos</h3>
        <div class="row">
            @if(isset($myVideos) && count($myVideos) > 0)
                @foreach($myVideos as $myVideo)
                    <div class="col-md-4 mb-4">
                        <div class="card rounded-3"> <!-- More rounded corners -->
                            <video class="card-img-top" controls>
                                <source src="{{ asset('storage/' . $myVideo->file_path) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <div class="card-body">
                                <h5 class="card-title">{{ $myVideo->title }}</h5>
                                <div class="d-flex justify-content-between">
                                    <div class="btn-group" role="group"> <!-- Button group for compactness -->
                                        <form action="{{ route('video.player', $myVideo->id) }}" method="GET" style="display:inline;">
                                            <button type="submit" class="btn btn-custom btn-sm">View</button>
                                        </form>
                                        <form action="{{ route('videos.edit', $myVideo->id) }}" method="GET" style="display:inline;">
                                            <button type="submit" class="btn btn-custom btn-sm">Edit</button>
                                        </form>
                                        <form action="{{ route('videos.destroy', $myVideo->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-custom btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No videos uploaded yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection

<style>
.video-player video {
    width: 900px; /* Fixed width */
    height: 506px; /* Aspect ratio of 16:9 */
    border-radius: 5px; /* Rounded corners */
}
.d-flex {
    display: flex;
    justify-content: space-between;
}
.video-details {
    max-width: 150px;
    /* Removed fixed margin, positioned absolutely */
}
.video-preview {
    width: 900px; /* Same as video player for alignment */
}
.form-control {
    border-radius: 25px; /* Rounded corners for input fields */
    border: 1px solid #ccc; /* Light gray border */
    padding: 10px; /* Add padding for a better feel */
    transition: border-color 0.3s;
}
.form-control:focus {
    border-color: #007bff; /* Blue border on focus */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Subtle shadow */
}
.btn-custom, .btn-file-custom {
    background-color: black; /* Black background */
    color: white; /* White text */
    border-radius: 50px; /* Pill-shaped corners */
    padding: 10px 20px; /* Padding for better appearance */
    border: none; /* Remove default border */
    transition: background-color 0.3s;
    display: inline-flex; /* Align text vertically in the middle */
    align-items: center; /* Align text vertically in the middle */
    white-space: nowrap; /* Prevent text wrapping */
}
.btn-custom:hover, .btn-file-custom:hover {
    background-color: #333; /* Darker shade on hover */
}
.btn-file-custom {
    margin-right: 30px; /* Adjust space between buttons */
}
.mb-3 {
    margin-bottom: 1.5rem !important; /* Increase vertical space */
}
.mb-4 {
    margin-bottom: 2rem !important; /* More space for Upload Video section */
}
.card {
    border-radius: 10px; /* Rounded corners for video cards */
    overflow: hidden; /* Prevents overflow of content */
}
.card video {
    border-radius: 0; /* No rounded corners for video in card */
}
.btn-sm {
    padding: 5px 10px; /* Adjust padding for smaller buttons */
    border-radius: 50px; /* Pill-shaped corners for small buttons */
}
.btn-group {
    display: flex; /* Use flexbox for grouping buttons */
    gap: 5px; /* Add some space between buttons */
}

/* Top Navigation Bar Style */
.navbar {
    padding: 0.5rem 1rem; /* Adjust the padding */
}
.navbar-nav .nav-item {
    margin-right: 100px; /* Adjust the space between nav items */
}
.navbar-nav .nav-link {
    padding: 0.5rem 0.75rem; /* Adjust link padding */
}
</style>
