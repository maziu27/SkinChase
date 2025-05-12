@extends('layouts.app')

@section('content')
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="flex-none">
            @include('includes.sidebar')
        </div>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-4">
            <div id="product-container" 
                class="grid xl:grid-cols-8 lg:grid-cols-6 md:grid-cols-4 sm:grid-cols-3 grid-cols-2  
                text-center">

                <!-- <img class="mx-auto w-full" src="{{ asset(path: 'images/SkinChase_logo-removebg-preview.png') }}" alt="Logo de SkinChase"> -->

            </div>
        </main>
    </div>
    <!-- Sidebar de la Cesta -->
    @include('includes.basket-side')
@endsection

@section('scripts')    
    <script src="{{ asset('js/products.js') }}"></script>
    
@endsection
