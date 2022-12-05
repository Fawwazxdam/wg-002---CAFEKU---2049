@extends('layouts.app')
@section('content')
<h2 class="text-center m-3">Dashboard</h2>
    <div class="row">
        <div class="col">
            <form action="{{route('dashboard.store')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama">
                </div>
                <div class="mb-3">
                    <label class="form-label">Pesanan</label>
                    <input type="text" class="form-control" name="pesanan">
                    <div class="form-text">Jika lebih dari 1, pisahkan dengan koma (,)</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" id="" class="form-select">
                        <option selected disabled>Pilih status</option>
                        <option value="member">Member</option>
                        <option value="regular">Regular</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-outline-light">Go</button>
            </form>
        </div>
        <div class="col">
            <table class="table table-dark">
                <thead>
                    <th colspan="2" class="text-center"><h6>Data Akan ditampilkan disini</h6></th>
                </thead>
                <tbody>
                    @isset($data)
                    <tr>
                        <th scope="row">Nama</th>
                        <td>{{$data['nama']}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Jumlah Pesanan</th>
                        <td>{{$data['jpesanan']}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Total Pesanan</th>
                        <td>Rp. {{$data['tpesanan']}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Status</th>
                        <td>{{$data['status']}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Diskon</th>
                        <td>Rp. {{$data['diskon']}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Total Pembayaran</th>
                        <td><h5>Rp. {{$data['tbayar']}}</h5></td>
                    </tr>
                    @endisset
                </tbody>
              </table>
        </div>
    </div>
@endsection
