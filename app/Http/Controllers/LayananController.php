<?php

namespace App\Http\Controllers;

use App\User;
use App\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $layanan = Layanan::all();
        return view('layanan.index', ['layanan' => $layanan], ['user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all();
        return view('layanan.create')->with('user', $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Layanan::create($request->all());
        return redirect('/layanan')->with('success', 'Layanan ' . $request->layanan . ' berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function show(Layanan $layanan)
    {
        $layanan = Layanan::all();
        return view('layanan/show', ['layanan' => $layanan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Layanan $layanan)
    {
        $user = User::all();
        return view('layanan.edit', compact('layanan'))->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Layanan $layanan)
    {
        // $layanan=findOrFail($id);
        $layanan->update($request->all());
        return redirect('/layanan')->with('warning', 'Layanan ' . $request->layanan . ' berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Layanan $layanan)
    {
        Layanan::destroy($layanan->id);
        return redirect('/layanan')->with('errorr', 'Layanan ' . $layanan->layanan . ' berhasil dihapus');
    }
}
