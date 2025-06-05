@extends('layouts.app')

@section('content')
    <h1 class="text-5xl text-center m-20">There has been an issue with your SkinChase purchase</h1>
    <h3 class="text-3xl text-center m-20">Please try again later </h3>
    <img class="mx-auto w-30" src="{{ asset(path: 'images/grownup-thumbs-down.png') }}" alt="no moneee for meee  :(( ">

@endsection