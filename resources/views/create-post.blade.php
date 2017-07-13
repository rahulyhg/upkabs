@extends('layouts.app')

@section('title')
Create Post
@endsection

@section('content')

    <!-- Navbar -->
    @include('elements.navbar')

    <!-- Side Navigation -->
    @include('elements.side-menu')

    <div class="col-md-8 col-md-offset-2">
        <!-- Tabs Post -->
        <ul class="nav nav-tabs main-tabs">
            <li class="active"><a data-toggle="tab" href="#post-a">New Post</a></li>
            <li><a data-toggle="tab" href="#post-b">New Link</a></li>
        </ul>

        <!-- Post Form -->
        <div class="panel panel-default main-container">
            <div class="panel-body">
                <div class="tab-content">
                    <div id="post-a" class="tab-pane fade in active">
                        <!-- Create Post Form -->
                        @include('elements.create-post-form')
                    </div>
                    <div id="post-b" class="tab-pane fade">
                        <!-- Create Post Form -->
                        @include('elements.create-link-form')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Terms And Conditions -->
    @include('elements.tc')
@endsection

@push('scripts')
    @include('links.image-validator')
    @include('links.link-preview')
    @include('links.create-post')
@endpush
