@extends('layouts.app')

<head>
    <meta http-equiv="refresh" content="0; URL={{ Auth::check() ? route('dashboard') : route('login') }}">
    <title>Redirecting...</title>
</head>
@section('content')
    <p>Redirecting you...</p>

@endsection
