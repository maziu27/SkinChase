@extends('layouts.app')

@section('content')
    <h1 class="text-center my-6 text-3xl font-bold text-purple-500">Welcome to SkinChase</h1>

    {{-- Perfil del usuario --}}
    <div class="max-w-5xl mx-auto bg-[#1A1D24] text-white rounded-xl p-6 shadow-lg space-y-6">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="flex items-center space-x-4">
                <img src="https://avatars.fastly.steamstatic.com/1792a5b9ef50f593698f3a5e6a9dad56c86b3b23_full.jpg" class="w-10 h-10 rounded-md">
                <div>
                    <p class="text-xl font-bold"> {{ Auth::user()->name }}</p>
                    <div class="flex items-center gap-2 text-sm mt-1">
                        <span class="bg-green-500 text-white px-2 py-1 rounded">Verified</span>
                        {{--<span class="bg-green-700 text-white px-2 py-1 rounded">Seller</span>--}}
                    </div>
                </div>
            </div>
            <span class="bg-green-500 text-white px-3 py-1 rounded-md font-medium mt-4 md:mt-0">✔ KYC Approved</span>
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
                    <p class="text-green-400 font-bold">2,676.82 €</p>
                </div>
                <div>
                    <p class="text-gray-400">Net</p>
                    <p class="text-yellow-400 font-bold">-106.55 €</p>
                </div>
            </div>
        </div>

        {{-- Account Standing --}}
        <div class="bg-[#2A2D34] p-4 rounded-lg">
            <h2 class="text-lg font-semibold mb-2">Account Standing</h2>
            <div class="flex items-center justify-between">
                <div class="w-full bg-gray-700 h-2 rounded relative">
                    <div class="absolute left-1/4 -translate-x-1/2 top-1/2 -translate-y-1/2 w-5 h-5 bg-blue-500 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 9l-6 6m0 0l-6-6m6 6V3" />
                        </svg>
                    </div>
                </div>
                <p class="ml-4 text-blue-400 font-medium">Good</p>
            </div>
            <p class="mt-2 text-sm text-gray-400">No recent restrictions</p>
        </div>

        {{-- Tabs (no funcionales por ahora) --}}
        <div class="flex space-x-4 border-b border-gray-600 text-sm text-gray-300 pt-4">
            <button class="pb-2 border-b-2 border-purple-500 text-purple-400 font-semibold">Personal Info</button>
            <button class="pb-2">Transactions</button>
            <button class="pb-2">Trades</button>
        </div>

        {{-- Personal Info --}}
        <div class="bg-[#2A2D34] p-4 rounded-lg">
            <h3 class="text-lg font-semibold flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A4 4 0 016 16h12a4 4 0 011 1.804M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Personal Info
            </h3>
            <p class="text-sm text-gray-400 mt-1 mb-4">Enter and change your personal information here.</p>

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
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

                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded">
                    Update Info
                </button>
            </form>
        </div>

        {{-- Botón de logout --}}
        <form method="POST" action="{{ route('logout') }}" class="text-center pt-4">
            @csrf
            <button type="submit"
                class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded transition">
                Log out
            </button>
        </form>
    </div>
@endsection