@extends('layouts.app')

@section('title')
Change Password
@endsection

@section('content')

    <!-- Navbar -->
    @include('elements.navbar')

    <!-- Side Navigation -->
    @include('elements.side-menu')

    <!-- Post -->
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-body">
                <!-- Create Post Form -->
                @include('elements.edit-password-form')
            </div>
            <div class="panel-footer">
                <a href="{{ url('profile/edit') }}" class="btn btn-default btn-block">Edit Profile</a>
            </div>
        </div>
    </div>

    <!-- Terms And Conditions -->
    @include('elements.tc')
@endsection

@push('scripts')
    @include('links.password')
@endpush
