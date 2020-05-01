<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Penjualan;
use App\PenjualanDetail;
use App\Sukucadang;
use PDF;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Penjualan::all();
        $data = Penjualan::with(['details.returpenjualan', 'details.sukucadang', 'customer'])->get();
        $type = 'penjualan';

        return view('pages.penjualan.index', compact(['data', 'penjualan']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $sukucadangs = Sukucadang::all();
        $randOne = PembelianController::random(14);
        $id = null;

        return view('pages.penjualan.form', compact(['customers', 'randOne', 'sukucadangs', 'id']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = [];
        for ($i = 0; $i < count($request->sukucadang_id); $i++) {
            array_push($data, ["sukucadang_id" => $request->sukucadang_id[$i], "harga_jual" => $request->harga_jual[$i], "harga_beli" => $request->harga_beli[$i], "total" => $request->total[$i], "jumlah" => $request->jumlah[$i]]);
        }

        $penjualan = new Penjualan;
        $penjualan->no_faktur = $request->no_faktur;
        $penjualan->total = $request->subtotal;
        $penjualan->customer_id = $request->customer_id;
        $penjualan->user_id = $request->user_id;
        // dd($penjualan, $data);

        if ($penjualan->save()) {
            foreach ($data as $item) {
                $detail = new PenjualanDetail;
                $detail->sukucadang_id = $item['sukucadang_id'];
                $detail->penjualan_id = $penjualan->id;
                $detail->jumlah = $item['jumlah'];
                $detail->harga_jual = $item['harga_jual'];
                $detail->total = $item['total'];
                $sukucadang = Sukucadang::findOrFail($item['sukucadang_id']);

                if ($sukucadang->update(['stock' => $sukucadang->stock - $item['jumlah']])) {
                    $detail->save();
                }
            }

            return redirect()->back()->withMessage('Request successfully executed. Click <a href="' . route('receipt', $penjualan->id) . '" style="color:#ef8157" target="_blank">here</a> to print receipt');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show(Penjualan $penjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penjualan $penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penjualan $penjualan)
    {
        //
    }

    public static function receipt($id, $readonyl = false)
    {
        $data = Penjualan::with(['customer', 'user', 'details.sukucadang'])->findOrFail($id);
        $pdf = PDF::loadView('pdf.receipt', compact(['data', 'readonly']));

        return $pdf->stream();
    }

    public function laporan()
    {
        $data = Penjualan::with(['details.returpenjualan', 'details.sukucadang', 'customer'])->get();
        $type = 'laporanpenjualan';

        return view('pages.penjualan.index', compact(['data', 'type']));
    }
}
