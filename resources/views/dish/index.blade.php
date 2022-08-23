@extends('layouts.app')

@section('content')
<div class="hr mb-3"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header header-color">List of Dishes</div>
                <div class="card-body">
                    @foreach ($dishes as $dish)
                    <div class="d-flex justify-content-start grey-line mb-3">

                        @if($dish->photo)
                        <div class="image-box mb-3 me-3">
                            <img src="{{$dish->photo}}">
                        </div>
                        @endif

                        <div class="d-flex flex-column justify-content-between mb-3">
                            <div>
                                <b>{{$dish->name}}</b><br>
                                {{$dish->description}}<br>
                                Menu: {{$dish->dishMenu->name}} <br>
                            </div>
                            <div class="mt-3">
                                <form method="post" action="{{route('order.add')}}">
                                    @csrf
                                    @method('post')
                                    <input class="order-select me-1" type="number" name="dish_count">
                                    <input type="hidden" value="{{$dish->id}}" name="dish_id">
                                    <button class="btn btn-outline-success me-3" type="submit">Order</button>
                                </form>
                            </div>


                            @if (Auth::user()->role > 9)
                            <div class="d-flex flex-row justify-content-start mt-1">
                                <a class="btn btn-outline-success me-1" href="{{route('dish.edit',$dish)}}">EDIT</a><br>
                                <form method="POST" action="{{route('dish.destroy', $dish)}}">
                                    @csrf
                                    <button class="btn btn-outline-secondary" type="submit">DELETE</button>
                                </form>
                            </div>
                            @endif

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
