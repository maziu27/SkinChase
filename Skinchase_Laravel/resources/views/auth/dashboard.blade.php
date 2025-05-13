@extends('layouts.app')
@section('content')
    <h1 class="text-center m-4 text-3xl text-purple-500">Welcome to SkinChase, {{ Auth::user()->name }}</h1>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
            <div class="mx-auto text-center items-center">
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded transition">
                    Log out
                </button>
            </div>
    </form>
@endsection