@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Create new Dish</div>
                <div class="card-body">
                    <form class="d-flex flex-column align-items-center" method="post" action="{{route('dish.store')}}" enctype="multipart/form-data">
                        Name: <input type="text" name="dish_name" required>
                        Description: 
                        <textarea class="form-control"name="dish_description" rows="3" required></textarea>
                        <select class="mt-3" name="menu_id">
                            @foreach ($menus as $menu)
                            <option value="{{$menu->id}}">{{$menu->name}}</option>
                            @endforeach
                        </select>
                        <div class="form-group mt-2">
                            <label>Photo of the dish</label>
                            <input class="form-control" type="file" name="dish_photo" />
                        </div>
                        @csrf
                        @method('post') 
                        <button class="btn btn-outline-success mt-3" type="submit">ADD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
