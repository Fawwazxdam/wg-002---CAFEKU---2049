<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //MENAMPILKAN HALAMAN DASHBOARD
        return view('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Deklarasi Variabel 
        $nama = $request->nama;
        $status = $request->status;
        $pesanan = explode(",",$request->pesanan);
        $tps = count($pesanan) * 50000;
        
        // MENGAMBIL DATA UNTUK DIPROSSES
        $ambil = new totalPembayaran($pesanan, $status, $tps);
        // MENAMPILKAN DATA YANG TELAH DI PR0SSES
        $data = [
            'nama' => $nama,
            'jpesanan' => count($pesanan),
            'tpesanan' => $tps,
            'status' => $status,
            'diskon' => $ambil->diskon(),
            'tbayar' => $ambil->totalBayar(),
        ];
        return view('dashboard',compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}



// INTERFACES DISKON
interface discount {
    public function diskon();
}
// MENAMPUNG DATA YANG DIKIR1M
class potongan implements discount {
        public function __construct($pesanan, $status, $tps) {
        $this->pesanan = $pesanan;
        $this->status = $status;
        $this->tps = $tps;
    }
    // MENGHIUNG DISKON
    public function diskon()
    {
        if ($this->status == 'member' && $this->tps >= 100000) {
            return $this->tps * 20 / 100;
        } else if($this->status == 'member' && $this->tps < 100000) {
            return $this->tps * 10 /100;
        } else {
            return 0;
        }
    }
}
class totalPembayaran extends potongan {
    // MENENTUKAN TOTAL PEMBAYARAN
    public function totalBayar()
    {
        return $this->tps - $this->diskon();
    }
}