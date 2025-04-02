<!--elementos de csfloat-->
@extends('layouts.app')

@section('content')

@include('includes.sidebar')

<div id="product-container">

</div>

@section('scripts')
<script src="{{ asset('js/products.js') }}"></script>
@endsection()

@endsection()