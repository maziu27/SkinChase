@extends('layouts.app')
@section('content')

<div class="relative overflow-hidden bg-gradient-to-b from-gray-900 to-[#0f0f1b]">
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-20">
        <div class="text-center">
            
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight text-white mb-6">
                <span class="block">Revolutionize Your</span>
                <span class="block m-2 text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-purple-600">CS2 Skin Trading</span>
            </h1>

            <div class="flex justify-center mb-8">
                <img class="h-full w-auto" src="{{ asset('images/SkinChase_logo-removebg-preview.png') }}" alt="SkinChase Logo">
            </div>
            
            <p class="mt-6 max-w-3xl mx-auto text-xl text-purple-200">
                The most advanced trading platform with real-time pricing, secure transactions, and instant CS2 skins delivery.
            </p>
            
            <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('market') }}" class="flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 md:py-4 md:text-lg md:px-10 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-purple-500/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Market
                </a>
            </div>
            
            <div class="mt-16 grid grid-cols-2 gap-8 md:grid-cols-4">
                <div class="col-span-1 flex flex-col text-center">
                    <span class="text-4xl font-extrabold text-purple-400">10K+</span>
                    <span class="mt-2 text-sm font-medium text-purple-200">Daily Transactions</span>
                </div>
                <div class="col-span-1 flex flex-col text-center">
                    <span class="text-4xl font-extrabold text-purple-400">500K+</span>
                    <span class="mt-2 text-sm font-medium text-purple-200">Active Users</span>
                </div>
                <div class="col-span-1 flex flex-col text-center">
                    <span class="text-4xl font-extrabold text-purple-400">100%</span>
                    <span class="mt-2 text-sm font-medium text-purple-200">Uptime</span>
                </div>
                <div class="col-span-1 flex flex-col text-center">
                    <span class="text-4xl font-extrabold text-purple-400">0</span>
                    <span class="mt-2 text-sm font-medium text-purple-200">Scam Reports</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-[#0f0f1b] py-10 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center">
            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-white sm:text-4xl">
                Why traders choose SkinChase
            </p>
        </div>

        <div class="mt-16">
            <div class="space-y-16 lg:space-y-0 lg:grid lg:grid-cols-3 lg:gap-x-8 lg:gap-y-16">
                <!-- Feature 1 -->
                <div class="group relative bg-gray-800 bg-opacity-50 p-6 rounded-xl hover:bg-opacity-70 transition-all duration-300 border border-gray-700 hover:border-purple-500">
                    <div class="absolute -top-6 left-6 flex items-center justify-center h-12 w-12 rounded-md bg-purple-500 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="mt-8 text-lg font-medium text-white">Secure Trading</h3>
                    <p class="mt-2 text-base text-purple-100">
                        Our system ensures safe transactions with no risk of scams or fraud.
                    </p>
                </div>

                <div class="group relative bg-gray-800 bg-opacity-50 p-6 rounded-xl hover:bg-opacity-70 transition-all duration-300 border border-gray-700 hover:border-purple-500">
                    <div class="absolute -top-6 left-6 flex items-center justify-center h-12 w-12 rounded-md bg-purple-500 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mt-8 text-lg font-medium text-white">Instant Delivery</h3>
                    <p class="mt-2 text-base text-purple-100">
                        Automated bot system delivers your skins instantly after purchase.
                    </p>
                </div>

                <div class="group relative bg-gray-800 bg-opacity-50 p-6 rounded-xl hover:bg-opacity-70 transition-all duration-300 border border-gray-700 hover:border-purple-500">
                    <div class="absolute -top-6 left-6 flex items-center justify-center h-12 w-12 rounded-md bg-purple-500 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h3 class="mt-8 text-lg font-medium text-white">Real-Time Pricing</h3>
                    <p class="mt-2 text-base text-purple-100">
                        Prices update in real-time based on market demand and availability.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection