<?php

namespace App\Http\Controllers;

use App\Pilihan;
use Illuminate\Http\Request;

class PilihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pilihan=Pilihan::all();
        return view('pilihan.index')->with('pilihan',$pilihan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('pilihan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Pilihan::create($request->all());
        return redirect('/pilihan')-> with('status','Indikator Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pilihan  $pilihan
     * @return \Illuminate\Http\Response
     */
    public function show(Pilihan $pilihan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pilihan  $pilihan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pilihan $pilihan)
    {
        return view('pilihan.edit', compact('pilihan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pilihan  $pilihan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pilihan $pilihan)
    {
        $pilihan->update($request->all());
        return redirect('/pilihan')-> with('status','Indikator Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pilihan  $pilihan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pilihan $pilihan)
    {
        Pilihan::destroy($pilihan->id);
        return redirect('/pilihan')-> with('status','Indikator Berhasil Dihapus');
    }
}
