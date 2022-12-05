@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center m-3">Our Menu</h2>
    <div class="row justify-content-center">
        @foreach($data as $menu)
        <div class="col-4">
        <div class="card bg-dark border-light p-2" style="width: 18rem; height: 30rem;">
            <img src="{{asset('storage/'.$menu->foto)}}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{$menu->nama_menu}}</h5>
              <p class="card-text">{{$menu->keterangan}}</p>
              <p class="card-text"><i>Kategori : {{$menu->kategori->nama_kategori}}</i></p>
              <p class="card-text">Rp. {{$menu->harga}}</p>
            </div>
          </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
