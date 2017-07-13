@extends('layouts.app')

@section('title')
Notification
@endsection

@section('content')
    <!-- Navbar -->
    @include('elements.navbar')

    <!-- Side Navigation -->
    @include('elements.side-menu')

    <!-- Create Post -->
    <a href="{{ url('post/create') }}">
        <div class="create-post">
            <i class="fa fa-pencil"></i>
        </div>
    </a>

    <!-- Post -->
    <div class="col-md-8 col-md-offset-2">
        <!-- Loader -->                
        @include('elements.loader')

        <!-- Clear Notifications -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default main-container">
                    <div class="panel-body">
                        <span class="notification-info" id="notification-info"></span>
                        <span class="btn btn-black btn-sm pull-right hidden" id="deactive-notification">Clear</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- All Posts -->
        <div class="row">
            <div class="col-md-12">
                <div id="notifications">
                    <!-- DOM -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('links.notification')
    @include('links.search-user')
@endpush
