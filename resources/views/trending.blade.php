@extends('layouts.app')

@section('title')
Trending
@endsection

@section('content')
    <!-- Navbar -->
    @include('elements.navbar')

    <!-- Side Navigation -->
    @include('elements.side-menu')

    <!-- Posts -->
    <div class="col-md-8 col-md-offset-2">

        <!-- Loader -->                
        @include('elements.loader')

        <!-- Create Post -->
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group btn-group-justified main-container" role="group">
                    <span class="btn btn-default btn-sm" id="most-commented">Most Commented</span>
                    <span class="btn btn-default btn-sm" id="most-upped">Most Up</span>
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
	@include('links.trending')
@endpush
