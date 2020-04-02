<?php

namespace App\Http\Controllers;
use App\Layanan;
use App\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori=Kategori::all();
        return view('kategori.index')->with('kategori',$kategori);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $layanan=Layanan::all();
        return view ('kategori.create')->with('layanan',$layanan);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Kategori::create($request->all());
        return redirect('/kategori')-> with('status','Indikator Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\kategori_layanan  $kategori_layanan
     * @return \Illuminate\Http\Response
     */
    public function show(kategori_layanan $kategori_layanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\kategori_layanan  $kategori_layanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        $layanan=Layanan::all();
        return view('kategori.edit', compact('kategori'))->with('layanan',$layanan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\kategori_layanan  $kategori_layanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        $kategori->update($request->all());
        return redirect('/kategori')-> with('status','Indikator Berhasil Diubah');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\kategori_layanan  $kategori_layanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        Kategori::destroy($kategori->id);
        return redirect('/kategori')-> with('status','Indikator Berhasil Dihapus');
    }
}
