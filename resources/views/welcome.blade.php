@extends('layouts.app')

@section('title')
Welcome to Upkabs
@endsection

@section('content')

    <!-- Navbar -->
    @include('elements.welcome-navbar')

    <div class="col-md-4 col-md-offset-4">

        <!-- Tabs Post -->
        <ul class="nav nav-tabs main-tabs">
            <li class="active"><a data-toggle="tab" href="#signin">Sign In</a></li>
            <li><a data-toggle="tab" href="#signup">Sign Up</a></li>
        </ul>

        <div class="panel panel-default main-container">
            <div class="panel-body">
                <div class="tab-content">
                    <div id="signin" class="tab-pane fade in active">
                        <!-- Sign In -->
                        @include('elements.signin-form')
                        <center><br/>
                        <a data-target="#forgot-password-modal" data-toggle="modal">Forgot Password?</a></center>
                    </div>
                    <div id="signup" class="tab-pane fade in">
                        <!-- Sign Up -->
                        @include('elements.signup-form')
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default text-center">
            <div class="panel-body">
                <a data-target="#about-modal" data-toggle="modal">About</a><br/>
                <span>Copyright &copy; UpKabs 2017</span>
            </div>
        </div>
    </div>

    <!-- Terms And Conditions -->
    @include('elements.forgot-password')
    @include('elements.about')
@endsection

@push('scripts')
    @include('links.signin')
@endpush
