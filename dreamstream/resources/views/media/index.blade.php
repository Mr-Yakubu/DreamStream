@extends('layouts.app')

@section('title', 'All Media')

@section('content')
<div class="container">
    <h1 class="mb-4">All Media</h1>

    @if($media->count() > 0)
        <div class="overflow-auto" style="max-height: 80vh;"> <!-- Set max height for scrollable area -->
            <div class="row">
                @foreach($media as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->title }}</h5>
                                <p class="card-text">{{ $item->description }}</p>
                                <a href="{{ route('media.show', $item->id) }}" class="btn btn-primary">View</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <p>No media available.</p>
    @endif
</div>
@endsection
