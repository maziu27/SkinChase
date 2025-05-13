@extends('layouts.app')
@section('content')
    <h1 class="text-center text-3xl">Welcome to SkinChase, {{ Auth::user()->name }}</h1>
    
    <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded transition">
                Log out
            </button>
        </form>
    
@endsection