@extends('layouts.app')

@section('title')
Sign Up Success
@endsection

@section('content')

    <!-- Navbar -->
    @include('elements.welcome-navbar')

    <div class="col-md-4 col-md-offset-4">

        <!-- Login Panel -->
        <div class="panel panel-default welcome-box">
            <div class="panel-heading text-center">
                <strong>Sign Up Success</strong>
            </div>
            <div class="panel-body text-center">
                Please check your email and go to <a href="{{ url('') }}">Sign In</a> page
            </div>
        </div>
    </div>
@endsection

