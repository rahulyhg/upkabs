@extends('layouts.app')

@section('title')
Trending
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

    <!-- Posts -->
    <div class="col-md-8 col-md-offset-2">

        <!-- Loader -->                
        @include('elements.loader')

        <!-- All Categories -->
        <div class="row">
            <div class="col-md-12">
                <div id="categories">
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
	@include('links.categories')
@endpush
