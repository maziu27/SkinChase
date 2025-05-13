@extends('layouts.app')

@section('content')
    <h1 class="text-5xl text-center m-20">{{ Auth::user()->name }} ,thank you for buying on SkinChase </h1>
    

    <img class="mx-auto w-25" src="{{ asset(path: 'images/thumbs-up.png') }}" alt="yay">

@endsection