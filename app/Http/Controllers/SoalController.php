<?php

namespace App\Http\Controllers;

use App\Soal;
use App\Pilihan;
use App\Layanan;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $layanan = Layanan::all();
        $soal = Soal::all();
        return view('soal.index', ['soal' => $soal, 'layanan' => $layanan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pilihan = Pilihan::all();
        $layanan = Layanan::all();
        return view('soal.create', [
            'layanan' => $layanan,
            'pilihan' => $pilihan

        ]);;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $soal = Soal::create([
            'dari' => $request->dari,
            'sampai' => $request->sampai,
            'layanan_id' => $request->layanan_id,
            'soal' => $request->soal,
        ]);
        $soal->pilihan()->sync($request->pilihan);
        return redirect('/soal')->with('status', 'Indikator Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function show(Soal $soal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function edit(Soal $soal)
    {
        $pilihan = Pilihan::all();
        $layanan = Layanan::all();
        return view('soal.edit', [
            'soal' => $soal,
            'pilihan' => $pilihan,
            'layanan' => $layanan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Soal $soal)
    {
        $soal->pilihan()->sync($request->pilihan);
        Soal::where('id', $soal->id)
            ->update([
                'dari' => $request->dari,
                'sampai' => $request->sampai,
                'layanan_id' => $request->layanan_id,
                'soal' => $request->soal,
            ]);
        return redirect('/soal')->with('status', 'Indikator Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Soal $soal)
    {
        Soal::destroy($soal->id);
        return redirect('/soal')->with('status', 'Indikator Berhasil Dihapus');
    }
}
