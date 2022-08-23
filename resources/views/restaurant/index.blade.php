@extends('layouts.app')

@section('content')
<div class="hr mb-3"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-color">
                <div class="card-header header-color">List of Restaurants</div>
                <div class="card-body">
                    <form class="d-flex flex-row justify-content-start mb-3" action="{{route('restaurant.index')}}" method="get">
                        <div class="col-4 mb-3">
                            <label>Search</label>
                            <input class="form-control" type="text" name="search" value="{{$search}}" />
                        </div>
                        <button type="submit" class="btn btn-success m-4">Search!</button>
                    </form>
                    @foreach ($restaurants as $restaurant)
                    <div class="d-flex flex-row justify-content-between grey-line mb-3">
                        <div>
                            <b>{{$restaurant->name}}</b><br>
                            {{$restaurant->code}}<br>
                            {{$restaurant->address}}<br>
                        </div>
                        @if (Auth::user()->role > 9)
                        <div class="d-flex flex-row align-items-end mb-2">
                            <a class="btn btn-outline-success ms-3" href="{{route('restaurant.edit',$restaurant)}}">EDIT</a><br>
                            <form method="POST" action="{{route('restaurant.destroy', $restaurant)}}">
                                @csrf
                                <button class="btn btn-outline-secondary ms-3" type="submit">DELETE</button>
                            </form>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
