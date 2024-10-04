@extends('layouts.app') <!-- Use your main layout -->

@section('content')
    <div class="container">
        <h1>Admin Dashboard</h1>

        <div class="dashboard-section">
            <h2>Account Information</h2>
            <p>Your account details go here...</p>
        </div>

        <div class="dashboard-section">
            <h2>Upload History</h2>
            <p>List of uploads made by the user...</p>
        </div>

        <div class="dashboard-section">
            <h2>User Activity</h2>
            <p>Recent user activities...</p>
        </div>

        <div class="dashboard-section">
            <h2>Settings</h2>
            <p>Manage your account settings...</p>
        </div>
    </div>
@endsection
