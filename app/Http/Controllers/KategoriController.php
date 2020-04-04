<?php

namespace App\Http\Controllers;
use App\Layanan;
use App\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    
    public function create(Layanan $layanan)
    {
        $kategori = $layanan->kategori()->paginate(10);
        return view ('layanan.kategori.create', [
            'layanan' => $layanan,
            'kategori' => $kategori
        ]);
    }

    public function store(Layanan $layanan, Request $request)
    {
        $request->validate([
            'kategori' => 'required'
        ]);

        Kategori::create([
            'layanan_id' => $layanan->id,
            'kategori' => $request->kategori
        ]);
        return back()-> with('status','Indikator Berhasil Ditambah');
    }

    public function show(kategori_layanan $kategori_layanan)
    {
        //
    }

    public function edit(Kategori $kategori)
    {
        $layanan=Layanan::all();
        return view('kategori.edit', compact('kategori'))->with('layanan',$layanan);
    }

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
