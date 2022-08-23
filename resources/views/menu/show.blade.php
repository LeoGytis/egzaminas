@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Information of {{$menu->name}}</div>
                <div class="card-body">
                    @foreach ($dishes as $dish)
                    @if ($dish->dishMenu->id === $menu->id)
                    <div class="d-flex justify-content-start grey-line">
                        <div class="image-box mb-1 mt-1 me-3">
                            <img src="{{$dish->photo}}">
                        </div>
                        <div>
                            <b>{{$dish->name}}</b><br>
                            {{$dish->description}}<br>
                        <div class="mt-3">
                            <form method="post" action="{{route('order.add')}}">
                                @csrf
                                @method('post')
                                <input class="order-select me-1" type="number" name="dish_count">
                                <input type="hidden" value="{{$dish->id}}" name="dish_id">
                                <button class="btn btn-outline-success me-3" type="submit">Order</button>
                            </form>
                        </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
