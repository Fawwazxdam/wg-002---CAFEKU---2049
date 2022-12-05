@extends('layouts.app')
@section('content')
    <h2 class="text-center">Menu</h2>
    <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#add">Add New</button>
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Menu</th>
                <th scope="col">Foto</th>
                <th scope="col">Harga</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Kategori</th>
                <th scope="col">Status</th>
                <th scope="col" colspan="2" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $menu)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $menu->nama_menu }}</td>
                    <td><img src="{{asset('storage/'.$menu->foto)}}" alt="" width="90px"></td>
                    <td>Rp. {{ $menu->harga }}</td>
                    <td>{{ $menu->keterangan }}</td>
                    <td>{{ $menu->kategori->nama_kategori }}</td>
                    <td>{{ $menu->status }}</td>
                    <td><button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#edit{{$menu->id}}">Edit</button></td>
                    <td><a href="{{url('delme/'.$menu->id)}}" class="btn btn-outline-light">Delete</a></td>
                </tr>

                {{-- MODAL EDIT --}}
                <div class="modal fade" id="edit{{$menu->id}}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-dark">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('menu.update',$menu->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="mb-3">
                                        <label class="form-label">Nama menu</label>
                                        <input type="text" class="form-control" name="nama_menu" value="{{$menu->nama_menu}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Foto</label><br>
                                        <img src="{{asset('storage/'.$menu->foto)}}" alt="" width="250px" class="img-thumbnail">
                                        <input type="file" class="form-control" name="foto" value="{{$menu->foto}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Harga</label>
                                        <input type="number" class="form-control" name="harga" value="{{$menu->harga}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan" value="{{$menu->keterangan}}">
                                    </div>
                                    <div class="mb-3">
                                            <label class="form-label">Satus</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="flexRadioDefault1" value="tersedia"
                                                    @if ($menu->status == 'tersedia') @checked(true) @endif>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Tersedia
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="flexRadioDefault2" value="habis"
                                                    @if ($menu->status != 'tersedia') @checked(true) @endif>
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    Habis
                                                </label>
                                            </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Kategori</label>
                                        <select name="kategori_id" id="" class="form-select">
                                            @foreach($data2 as $kategori)
                                                <option value="{{$kategori->id}}" @selected($menu->kategori_id == $kategori->id)>{{$kategori->nama_kategori}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-outline-success">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END M0DAL EDIT --}}
            @endforeach
        </tbody>
    </table>


    {{-- MODAL ADD --}}
    <div class="modal fade" id="add" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('menu.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama menu</label>
                            <input type="text" class="form-control" name="nama_menu" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" class="form-control" name="foto" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" class="form-control" name="harga" placeholder="Rp." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <select name="kategori_id" id="" class="form-select">
                                <option selected disabled>Pilih Kategori</option>
                                @foreach($data2 as $kategori)
                                    <option value="{{$kategori->id}}">{{$kategori->nama_kategori}}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
