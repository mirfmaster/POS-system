<?php

namespace App\Http\Controllers;

use App\Pembelian;
use App\Sukucadang;
use App\Supplier;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        $sukucadangs = Sukucadang::all();

        $randOne = $this->random(14);
        $randTwo = $this->random(14);

        return view('pages.pembelian.form', compact(['suppliers', 'sukucadangs', 'randOne', 'randTwo']));
    }

    public static function random($length)
    {
        return strtoupper(substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, $length));
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
        $data = [];
        for ($i = 0; $i < count($request->nama); $i++) {
            array_push($data, ["nama" => $request->nama[$i], "harga_jual" => $request->harga_jual[$i], "harga_beli" => $request->harga_beli[$i], "total" => $request->total[$i], "jumlah" => $request->jumlah[$i]]);
        }

        $pembelian = new Pembelian;
        $pembelian->no_faktur = $request->no_faktur;
        $pembelian->no_surat_jalan = $request->no_surat_jalan;
        $pembelian->metode_bayar = $request->metode_bayar;
        $pembelian->jatuh_tempo = $request->jatuh_tempo;
        $pembelian->total = $request->subtotal;
        $pembelian->supplier_id = $request->supplier_id;
        $pembelian->user_id = $request->user_id;
        // dd($pembelian, $data);

        if ($pembelian->save()) {
            foreach ($data as $item) {
                $sukucadang = new Sukucadang();
                $sukucadang->nama = $item['nama'];
                $sukucadang->jumlah = $item['jumlah'];
                $sukucadang->harga_beli = $item['harga_beli'];
                $sukucadang->harga_jual = $item['harga_jual'];
                $sukucadang->total = $item['total'];
                $sukucadang->pembelian_id = $pembelian->id;

                $sukucadang->save();
            }

            return redirect()->back()->withStatus('success');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function show(Pembelian $pembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembelian $pembelian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembelian $pembelian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembelian $pembelian)
    {
        //
    }
}
