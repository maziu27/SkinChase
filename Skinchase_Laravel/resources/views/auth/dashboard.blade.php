@extends('layouts.app')
@section('content')
    <h1 class="text-center text-3xl">Welcome, {{ Auth::user()->name }}</h1>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="text-center text-xl" type="submit">Log out</button>
    </form>
    
@endsection