@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-900 text-white px-4">
        <div class="text-center">
            <h1 class="text-3xl font-bold mb-6">Session expired... :/</h1>
            <a href="{{route('home')}}">
                Go back! :0
            </a>
            <img class="mx-auto max-w-xs rounded shadow-lg" src="{{ asset('images/404.jpg') }}" alt="Not available emohi">
        </div>
    </div>
@endsection
