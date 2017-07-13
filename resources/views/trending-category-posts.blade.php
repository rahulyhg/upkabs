@extends('layouts.app')

@section('title')
Upkabs
@endsection

@section('content')
    <!-- Create Post -->
    <a href="{{ url('post/create') }}">
        <div class="create-post">
            <i class="fa fa-pencil"></i>
        </div>
    </a>
    <!-- Navbar -->
    @include('elements.navbar')
    <!-- Side Navigation -->
    @include('elements.side-menu')
    <!-- Horizontal Category -->
    @include('elements.horizontal-category')
    <!-- Posts -->
    <div class="col-md-8 col-md-offset-2 timeline-container">
        <!-- Loader -->
        @include('elements.loader')        
        <!-- Create Post -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default main-container text-center">
                    <div class="panel-body"><span id="selected-category">{{ Session::get('category') }}</span></div>
                </div>
            </div>
        </div>
        <!-- All Posts -->
        <div class="row">
            <div class="col-md-12">
                <div id="posts">
                    <!-- DOM -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Pagination -->
                <div id="pagination-posts" class="pull-right"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>
    </div>
@endsection

@push('scripts')
	@include('links.trending-category-posts')
@endpush
