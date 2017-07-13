@extends('layouts.app')

@section('title')
Upkabs
@endsection

@section('content')
    <!-- Navbar -->
    @include('elements.navbar')

    <!-- Side Navigation -->
    @include('elements.side-menu')

    <!-- Post -->
    <div class="col-md-8 col-md-offset-2" id="post">
        @include('elements.post')
    </div>
@endsection

@push('scripts')
    @include('links.comment')
	@include('links.up')
	@include('links.post')
@endpush
  
