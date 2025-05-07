@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-900 text-white px-4">
        <div class="text-center">
            <h1 class="text-3xl font-bold mb-6">We are in maintenance... we will be back shortly</h1>
            <img class="mx-auto max-w-xs rounded shadow-lg" src="{{ asset('images/patrick-hammer.jpg') }}" alt="Maintenance Image">
        </div>
    </div>
@endsection
