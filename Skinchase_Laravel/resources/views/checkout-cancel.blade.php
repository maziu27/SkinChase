@extends('layouts.app')

@section('content')
    <h1 class="text-5xl text-center m-20">Ha habido un problema con tu compra en SkinChase</h1>
    <h3 class="text-3xl text-center m-20">Por favor, vuelve a intentarlo más tarde</h3>
    <img class="mx-auto w-30" src="{{ asset(path: 'images/grownup-thumbs-down.png') }}" alt="no moneee for meee  :(( ">

@endsection