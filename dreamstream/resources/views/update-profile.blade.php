@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header text-center">
                    <h2>Update Profile Picture</h2>
                </div>
                <div class="card-body">
                    <!-- Current Profile Picture -->
                    <div class="text-center mb-4">
                        <h4>Current Profile Picture</h4>
                        <img id="currentProfilePicture" 
                             src="{{ asset('images/profiles/' . (session('profile_picture') ?? 'default.png')) }}" 
                             alt="Profile Picture" 
                             style="width: 150px; height: 150px; border-radius: 50%; border: 2px solid #333;">
                    </div>
                    
                    <!-- Profile Picture Upload Form -->
                    <form action="{{ route('profile.picture.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3 text-center">
                            <label for="profile_picture" class="form-label">Upload New Profile Picture</label>
                            <input type="file" id="profile_picture" name="profile_picture" class="form-control" accept="image/*" required>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-custom">Update Picture</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .btn-custom {
        background-color: black; 
        color: white; 
        border-radius: 50px; 
        padding: 10px 20px; 
        transition: background-color 0.3s;
    }

    .btn-custom:hover {
        background-color: #333; 
    }

    .form-control {
        border-radius: 25px; 
        border: 1px solid #ccc; 
        padding: 10px; 
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: #007bff; 
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); 
    }

    .card {
        background-color: #fff;
        border-radius: 10px;
    }
</style>
