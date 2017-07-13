@extends('layouts.app')

@section('title')
Edit My Profile
@endsection

@section('content')

    <!-- Navbar -->
    @include('elements.navbar')

    <!-- Side Navigation -->
    @include('elements.side-menu')

    <!-- Post -->
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default main-container">
            <!-- Avatar -->
            <div class="thumbnail card-thumbnail">
                <img class="media-object" src="{{ $avatar_url.$user['avatar'] }}" alt="{{ $user['name'] }}">
            </div>
                
            <div class="panel-body">
                <!-- Create Post Form -->
                @include('elements.edit-profile-form')
            </div>
            <div class="panel-footer">
                <a href="{{ url('profile/deactive') }}" class="btn btn-default btn-block">Deactive</a>
                <a href="{{ url('profile/password') }}" class="btn btn-default btn-block">Change Password</a>
            </div>
        </div>
    </div>

    <!-- Terms And Conditions -->
    @include('elements.tc')
@endsection

@push('scripts')
    @include('links.notification')
    @include('links.image-validator');
@endpush
