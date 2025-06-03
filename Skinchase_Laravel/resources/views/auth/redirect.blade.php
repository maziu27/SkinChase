@extends('layouts.app')

@section('title', 'Redirecting | SkinChase')

<head>
    <meta http-equiv="refresh" content="0; URL={{ Auth::check() ? route('dashboard') : route('login') }}">
    <title>Redirecting...</title>
</head>
@section('content')
    <div class="flex items-center justify-center">
        <div class="text-center text-5xl text-purple-400 m-5">
            <p>Redirecting you...</p>
        </div>
    </div>
@endsection

