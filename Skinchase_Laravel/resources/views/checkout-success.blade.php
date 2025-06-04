@extends('layouts.app')

@section('content')
    @auth
        <div class="min-h-screen bg-gray-900 text-white px-4 py-8">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-5xl font-bold text-center mb-8 text-purple-400">
                    {{ Auth::user()->name }}, thank you for buying on SkinChase 🎉
                </h1>
                
                <div class="bg-gray-800 rounded-lg p-6 mb-8">
                    <h2 class="text-2xl font-semibold mb-4 text-green-400">Order Summary</h2>
                    
                    <div class="space-y-4">
                        @foreach($items as $item)
                        <div class="flex items-start border-b border-gray-700 pb-4">
                            <img src="https://steamcommunity-a.akamaihd.net/economy/image/{{ $item['image'] }}" 
                                 alt="{{ $item['name'] }}" 
                                 class="w-16 h-16 object-contain mr-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-medium">{{ $item['name'] }}</h3>
                            </div>
                            <div class="text-right">
                                <p class="text-green-400 font-bold">€{{ number_format($item['price'], 2) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-6 pt-4 border-t border-gray-700 flex justify-between items-center">
                        <span class="text-xl font-semibold">Total:</span>
                        <span class="text-2xl text-green-400 font-bold">
                            €{{ number_format(array_sum(array_column($items, 'price')), 2) }}
                        </span>
                    </div>
                </div>
                
                <div class="text-center">
                    <a href="{{ route('market') }}" 
                       class="inline-block bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg font-medium transition">
                        Back to Market
                    </a>
                </div>
                
                <img class="w-48 h-auto mx-auto mt-12" src="{{ asset('images/thumbs-up.png') }}" alt="Thumbs up">
            </div>
        </div>
    @else
        <script>
            window.location.href = "{{ route('login') }}";
        </script>
    @endauth
@endsection