<?php

namespace App\Http\Controllers;

use App\Soal;
use App\Pilihan;
use App\Jawaban;
use App\Layanan;
use App\Pilihan_soal;
use App\User;
use App\Kategori;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class JawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $layanan = Layanan::all();
        $kategori = Kategori::all();
        return view('jawaban.card', ['layanan' => $layanan], ['kategori' => $kategori]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return dd($request);
        $soal = Soal::all();
        $pilihan = Pilihan::orderBy('value', 'desc')->get();
        $pilihan_soal = Pilihan_soal::all();
        $user = User::all();
        $layanan = Layanan::all();
        $kategori = Kategori::all();
        return view('jawaban.index', [
            'layanan' => $layanan, 'kategori' => $kategori,
            'request' => $request, 'soal' => $soal, 'pilihan' => $pilihan,
            'pilihan_soal' => $pilihan_soal, 'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return dd($request);
        // $size = count(collect($request)->get('nilai'));
        // for ($i = 0; $i < $size; $i++) {
        //     $data[] = [
        //         'user_id' => $request->user_id,
        //         'soal_id' => $request->soal[$i],
        //         'layanan_id' => $request->layanan_id,
        //         'kategori_id' => $request->kategori_id,
        //         'nilai' => $request->nilai[$request->soal[$i]],
        //         'status' => 1,
        //         'kritik' => $request->kritik,
        //         'created_at' => Carbon::now()->setTimezone('Asia/Singapore'),
        //         'updated_at' => Carbon::now()->setTimezone('Asia/Singapore'),
        //     ];
        // }
        // Jawaban::insert($data);
        // return redirect('/jawaban')->with('status', 'Evaluasi anda berhasil masuk');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    public function show(Jawaban $jawaban)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    public function edit(Jawaban $jawaban)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jawaban $jawaban)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jawaban $jawaban)
    {
        //
    }
}
