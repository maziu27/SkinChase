@extends('layouts.app')

@section('title', 'Inventory | SkinChase')

@section('content')

@include('includes.scripts')

@section('content')
<h1 class="text-center p-3 text-purple-400 text-4xl md:text-6xl font-bold mb-6 leading-tight">{{Auth::user()->name}}'s Steam Inventory</h1>

<div class="max-w-6xl mx-auto p-4">
    <div id="inventory-container" class="flex-1 grid gap-4 xl:grid-cols-5 lg:grid-cols-5 md:grid-cols-3 sm:grid-cols-3 grid-cols-2 overflow-hidden">
        <!-- Inventory items will be injected here by inventory.js -->
    </div>
</div>
@endsection
<script src="{{"js/inventory.js"}}">

</script>