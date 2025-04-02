@extends('layouts.app')

@section('content')
    <h1>Steam Inventory</h1>

    @if(isset($error))
        <p>{{ $error }}</p>
    @else
        <div class="inventory-items">
            @foreach($items as $item)
                <div class="item">
                    <img src="{{ $item['icon_url'] }}" alt="{{ $item['name'] }}">
                    <p>Name: {{ $item['name'] }}</p>
                    <p>Rarity: {{ $item['rarity'] }}</p>
                    <p>Weapon Type: {{ $item['weapon_type'] }}</p>
                </div>
            @endforeach
        </div>
    @endif
@endsection
