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
use Illuminate\Support\Facades\Auth;

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
        $tahunSekarang = Carbon::now()->format('Y');
        $bulan = Carbon::now()->format('m');
        $user = Auth::user()->id;
        // dd($bulan);
        return view('jawaban.card', [
            'layanan' => $layanan,
            'tahunSekarang' => $tahunSekarang,
            'bulanSekarang' => $bulan,
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Kategori $kategori)
    {
        $user = Auth::user()->id;
        $tahunSekarang = Carbon::now()->format('Y');
        if ($kategori->jawaban->where('user_id', $user)->pluck('genap')->first() == 1) {
            if ($tahunSekarang == $kategori->where('user_id', $user)->pluck('tahun')->first()) {
                return back();
            }
        }
        if ($kategori->jawaban->where('user_id', $user)->pluck('ganjil')->first() == 1) {
            if ($tahunSekarang == $kategori->jawaban->where('user_id', $user)->pluck('tahun')->first()) {
                return back();
            }
        }

        $layanan = $kategori->layanan;
        $soal = $layanan->soal()->get();

        return view('jawaban.index', [
            'soal' => $soal,
            'kategori' => $kategori,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Kategori $kategori)
    {
        // return dd($request);
        $userId = Auth::user()->id;
        $bulanSekarang = Carbon::now()->format('m');
        $tahunSekarang = Carbon::now()->format('Y');
        $ganjil = 0;
        $genap = 0;

        if ($bulanSekarang >= 1 && $bulanSekarang <= 6) {
            $genap = 1;
        }

        if ($bulanSekarang >= 7 && $bulanSekarang <= 12) {
            $ganjil = 1;
        }

        $size = count(collect($request)->get('nilai'));
        for ($i = 0; $i < $size; $i++) {
            $data[] = [
                'user_id' => $userId,
                'soal_id' => $request->soal[$i],
                'layanan_id' => $kategori->layanan->id,
                'kategori_id' => $kategori->id,
                'nilai' => $request->nilai[$request->soal[$i]],
                'status' => 1,
                'kritik' => $request->kritik,
                'ganjil' => $ganjil,
                'genap' => $genap,
                'tahun' => $tahunSekarang,
                'created_at' => Carbon::now()->setTimezone('Asia/Singapore'),
                'updated_at' => Carbon::now()->setTimezone('Asia/Singapore')
            ];
        }

        Jawaban::insert($data);

        return redirect('/jawaban')->with('success', 'Evaluasi anda' . ' berhasil ditambahkan');
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
