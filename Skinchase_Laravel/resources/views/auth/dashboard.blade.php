@extends('layouts.app')

@section('content')
    <h1 class="text-center my-6 text-3xl font-bold text-purple-500">Welcome back, {{Auth::user()->name}} </h1>

    {{-- Perfil del usuario --}}
    <div class="max-w-5xl mx-auto bg-[#1A1D24] text-white rounded-xl p-6 shadow-lg space-y-6">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="flex items-center space-x-4">
                @if(Auth::user()->profile_picture)
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="w-24 h-24 rounded-full">
                @endif
                <div>
                    <p class="text-xl font-bold"> {{ Auth::user()->name }}</p>
                    <div class="flex items-center gap-2 text-sm mt-1">
                    </div>
                </div>
            </div>
            <span class="bg-green-500 text-white px-3 py-1 rounded-md font-medium mt-4 md:mt-0">✔ Verified</span>
        </div>

        {{-- Earnings --}}
        <div class="bg-[#2A2D34] p-4 rounded-lg">
            <h2 class="text-lg font-semibold mb-2">Earnings</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                {{--
                <div>
                    <p class="text-gray-400">Sales</p>
                    <p class="text-green-400 font-bold">2,570.27 €</p>
                </div>
                --}}
                <div>
                    <p class="text-gray-400">Purchases</p>
                    <p class="text-green-400 font-bold">n/a €</p>
                </div>
                <div>
                    <p class="text-gray-400">Net</p>
                    <p class="text-yellow-400 font-bold">n/a €</p>
                </div>
            </div>
        </div>

        
        {{-- Tabs (no funcionales por ahora) --}}
        <div class="flex space-x-4 border-b border-gray-600 text-sm text-gray-300 pt-4">
            <button class="pb-2 border-b-2 border-purple-500 text-purple-400 font-semibold">Personal Info</button>
            <button class="pb-2">Items for sale</button>
            <button class="pb-2">Transactions</button>
            <button class="pb-2">Trades</button>
        </div>

        {{-- Personal Info --}}
        <div class="bg-[#2A2D34] p-4 rounded-lg">
            <h3 class="text-lg font-semibold flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A4 4 0 016 16h12a4 4 0 011 1.804M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Personal Info
            </h3>
            <p class="text-sm text-gray-400 mt-1 mb-4">Enter and change your personal information here.</p>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm text-gray-300 mb-1" for="email">Email address</label>
                    <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}"
                        class="w-full bg-gray-800 text-white border border-gray-600 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>

                <div>
                    <label class="block text-sm text-gray-300 mb-1" for="password">New Password</label>
                    <input type="password" name="password" id="password"
                        class="w-full bg-gray-800 text-white border border-gray-600 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>

                <div>
                    <label class="block text-sm text-gray-300 mb-1" for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full bg-gray-800 text-white border border-gray-600 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>

                <div>
                    <label class="block text-sm text-gray-300 mb-1" for="trade_link">Steam Trade Link</label>
                    <input type="url" name="trade_link" id="trade_link" value="{{ old('trade_link', Auth::user()->trade_link) }}" 
                    class="w-full bg-gray-800 text-white border border-gray-600 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    
                </div>

                <div>
                    <label class="block text-sm text-gray-300 mb-1" for="profile_picture">Profile Picture</label>
                    <input type="file" name="profile_picture" id="profile_picture"
                        class="w-full bg-gray-800 text-white border border-gray-600 rounded px-4 py-2">
                </div>

                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white text-center px-4 py-2 rounded">
                    Update Info
                </button>
            </form>
        </div>

        {{-- Botón de logout --}}
        <form method="POST" action="{{ route('logout') }}" class="text-center pt-4">
            @csrf
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded transition">
                Log out
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center pt-4">
            @csrf
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded transition">
                Delete account
            </button>
        </form>

        
    </div>
@endsection