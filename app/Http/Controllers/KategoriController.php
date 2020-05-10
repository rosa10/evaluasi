<?php

namespace App\Http\Controllers;
use App\Layanan;
use App\Kategori;
use App\User;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    
    public function create(Layanan $layanan)
    {
        $admin = 'admin';
        $dosen = 'dosen';
        $user = User::whereHas('roles', function ($query) use ($admin, $dosen) {
            $query
                ->where('name', $admin)
                ->orWhere('name', $dosen);
        })->get();
        $kategori = $layanan->kategori()->paginate(10);
        return view ('layanan.kategori.create', [
            'layanan' => $layanan,
            'kategori' => $kategori
        ])->with('user',$user);
    }

    public function store(Layanan $layanan, Request $request)
    {
        $request->validate([
            'kategori' => 'required'
        ]);

        Kategori::create([
            'user_id'=>$request->user_id,
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
        $admin = 'admin';
        $dosen = 'dosen';
        $user = User::whereHas('roles', function ($query) use ($admin, $dosen) {
            $query
                ->where('name', $admin)
                ->orWhere('name', $dosen);
        })->get();
        $layanan=Layanan::all();
        return view('layanan.kategori.edit', [
            'layanan' => $layanan,
            'kategori' => $kategori
        ])->with('user',$user);
    }

    public function update(Request $request, Kategori $kategori)
    {
        $kategori->update($request->all());
        return redirect('/layanan')-> with('status','Indikator Berhasil Diubah');
        
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
        return redirect('/layanan')-> with('status','Indikator Berhasil Dihapus');
    }
}
