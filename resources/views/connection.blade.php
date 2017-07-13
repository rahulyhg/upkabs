@extends('layouts.app')

@section('title')
Connection
@endsection

@section('content')

    <!-- Navbar -->
    @include('elements.navbar')

    <!-- Side Navigation -->
    @include('elements.side-menu')
    
    <!-- Users -->
    <div class="col-md-8 col-md-offset-2">

        <!-- Loader -->                
        @include('elements.loader')

        <!-- Search User -->
        <div class="row">
            <div class="col-md-12">
                <!-- Search -->
                @include('elements.search-user-form')
            </div>
        </div>

        <!-- All Posts -->
        <div class="row">
            <div class="col-md-12">
                <div id="users">
                    <!-- DOM -->
                </div>        
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- Pagination -->
                <div id="pagination-users" class="pull-right"></div>        
            </div>
        </div>
    </div>
@endsection

@push('scripts')
	@include('links.connection')
@endpush
