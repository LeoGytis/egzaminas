@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Information of the restaurant {{$restaurant->name}} {{$restaurant->surname}} </div>
                <div class="card-body">
                    <b>Name:</b> {{$restaurant->name}}<br>
                    <b>Code:</b> {{$restaurant->code}}<br>
                    <b>Address:</b> {{$restaurant->address}}<br>
                    <b>Menus:</b><br>
                    @foreach ($menus as $menu)
                    @if ($menu->menuRestaurant->id === $restaurant->id)
                    {{$menu->name}}
                    <a class="btn btn-success btn-sm ms-3 mb-1" href="{{route('menu.show', $menu->id)}}">Show</a><br>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
