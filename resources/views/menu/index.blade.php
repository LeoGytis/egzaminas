@extends('layouts.app')

@section('content')
<div class="hr mb-3"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-color">
                <div class="card-header header-color">List of Menus</div>
                <div class="card-body">
                    @foreach ($menus as $menu)
                    <div class="d-flex flex-row justify-content-between grey-line mb-3">
                        <div>
                            <b>{{$menu->name}}</b><br>
                            Restaurant: {{$menu->menuRestaurant->name}} <br>
                        </div>


                        @if (Auth::user()->role > 9)
                        <div class="d-flex flex-row align-items-end mb-2">
                            <a class="btn btn-outline-success ms-3" href="{{route('menu.edit',$menu)}}">EDIT</a><br>
                            <form method="POST" action="{{route('menu.destroy', $menu)}}">
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
