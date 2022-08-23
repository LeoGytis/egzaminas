@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Create new menu</div>
                <div class="card-body">
                    <form class="d-flex flex-column align-items-center" method="POST" action="{{route('menu.store')}}">
                        <div class="col-md-4 ms-3 mb-3">
                            Name: <input type="text" name="menu_name" required>
                            <select class="mt-3" name="restaurant_id">
                                @foreach ($restaurants as $restaurant)
                                <option value="{{$restaurant->id}}">{{$restaurant->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @csrf
                        <button class="btn btn-outline-success mt-3" type="submit">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection