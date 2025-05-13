@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row h-screen bg-gray-900">
    <!-- Sidebar -->
    <div id="sidebar" class="md:w-64 w-full border-b md:border-r border-gray-900 md:h-full">
        @include('includes.sidebar')
    </div>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto p-4">
        <div id="product-container"
            class="grid gap-4 xl:grid-cols-6 lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 grid-cols-2">
            {{-- Dynamic products loaded via JS --}}
        </div>
    </main>

    <!-- Basket Sidebar for Mobile -->
    <div class="flex bottom-0 left-0 right-0 md:hidden  shadow p-4">
        @include('includes.basket-side')
    </div>

    <!-- Basket Sidebar for Desktop -->
    <div class="flex md:block md:w-72 border-l border-gray-900">
        @include('includes.basket-side')
    </div>
</div>
@endsection

@section('scripts')    
<script src="{{ asset('js/products.js') }}"></script>
@endsection