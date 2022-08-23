@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit {{$dish->name}}</div>
                <div class="card-body">
                    <form class="d-flex flex-column align-items-center" method="post" action="{{route('dish.update',$dish)}}" enctype="multipart/form-data">
                        <div class="col-md-4 ms-3 mb-3">
                            Name: <input class="ms-3 mt-3" type="text" name="dish_name" value="{{$dish->name}}" required><br>

                            <select class="mt-3" name="menu_id">
                                @foreach ($menus as $menu)
                                <option value="{{$menu->id}}" @if($menu->id == $dish->menu_id) selected @endif>
                                    {{$menu->name}}
                                </option>
                                @endforeach
                            </select>

                        <br>Description: <input class="ms-3 mt-3" type="text_field" name="dish_description" value="{{$dish->price}}" required><br>


                            @if($dish->photo)
                            <div class="image-box mt-3 me-3">
                                <img src="{{$dish->photo}}">
                            </div>
                            @endif

                            <div class="form-group mt-2">
                                <label>Photo of the dish</label>
                                <input class="form-control" type="file" name="dish_photo" />
                            </div>

                        </div>
                        @csrf
                        @method('put')
                        <button class="btn btn-outline-success mt-3 mb-3" type="submit">Save</button>
                    </form>

                    @if($dish->photo)
                    <form class="d-flex flex-column align-items-center" action="{{route('dish.delete-picture', $dish)}}" method="post">
                        @csrf
                        @method('put')
                        <button class="btn btn-outline-danger mt-4" type="submit">Delete picture</button>
                    </form>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
