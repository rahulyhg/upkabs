@extends('layouts.app')

@section('title')
Profile
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

    <div class="col-md-8 col-md-offset-2">
        @include('elements.user-info')

        <!-- Loader -->
        @include('elements.loader')

        <!-- User's Posts -->
        <div id="user-posts">
            <!-- DOM -->
        </div>
        
        <!-- Pagination -->
        <div id="pagination-user-posts" class="pull-right"></div>
    </div>
@endsection

@push('scripts')
    @include('links.profile')
@endpush
