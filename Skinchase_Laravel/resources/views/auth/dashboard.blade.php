@extends('layouts.app')
@section('content')
    <h1>Welcome, {{ Auth::user()->name }}</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Log out</button>
    </form>
@endsection