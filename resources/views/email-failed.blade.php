@extends('layouts.app')

@section('title')
Sign Up Failed
@endsection

@section('content')

    <!-- Navbar -->
    @include('elements.welcome-navbar')

    <div class="col-md-4 col-md-offset-4">

        <!-- Login Panel -->
        <div class="panel panel-default welcome-box">
            <div class="panel-heading text-center">
                <strong>Sign Up Failed</strong>
            </div>
            <div class="panel-body text-center">
            	Email already used or an error connection<br/>
                Please try to <a href="{{ url('') }}">Sign Up</a> again
            </div>
        </div>
    </div>
@endsection

