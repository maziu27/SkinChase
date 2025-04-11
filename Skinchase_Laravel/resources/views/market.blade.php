@extends('layouts.app')

@section('content')
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="flex-none">
            @include('includes.sidebar')
        </div>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-4">
            <div id="product-container" class="overflow-auto hide-scrollbar bg-gray-800 border-gray-900 grid grid-cols-2 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-7 gap-4 p-4">
                
            </div>
        </main>
    </div>

@endsection

@section('scripts')    
    <script src="{{ asset('js/basket.js') }}"></script>
    <script src="{{ asset('js/products.js') }}"></script>
@endsection
