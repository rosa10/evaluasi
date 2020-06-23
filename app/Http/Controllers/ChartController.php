<?php

namespace App\Http\Controllers;

use App\Charts\Charts;
use App\User;
use App\Jawaban;
use App\Soal;
use App\Kategori;
use App\Layanan;
use App\Pilihan;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {

        $layanan = Layanan::all();
        $kategori = Kategori::all();
        return view('Chart.Chart', [
            'layanan' => $layanan,
            'kategori' => $kategori
        ]);
    }

    public function chart(Request $request)
    {

        $soal = Soal::where('layanan_id', $request->layanan_id)->get();

        return view('Chart.Chart2', [
            'soal' => $soal,
            'kategori' => $request->kategori_id,
            'dari' => $request->dari,
            'sampai' => $request->sampai
        ]);
    }

    public function chartData(Kategori $kategori, Request $request)
    {

        $soal = Soal::where('layanan_id', $kategori->layanan->id)->get();
        $namaSoal = [];
        $dari = new Carbon($request->dari);
        $sampai = new Carbon($request->sampai);

        foreach ($soal as $itemSoal) {
            $pilihan = [];
            $nilai = [];

            foreach ($itemSoal->pilihan as $itemPilihan) {
                array_push($pilihan, $itemPilihan->pilihan);
                array_push($nilai,  $itemSoal->jawaban()->where('nilai', $itemPilihan->value)->where('kategori_id', $kategori->id)->whereBetween('created_at', [$dari, $sampai])->count());
            }

            array_push($namaSoal, [
                'soal' => $itemSoal->soal,
                'pilihan' => $pilihan,
                'nilai' => $nilai
            ]);
        }

        return response()->json([
            'soal' => $namaSoal
        ]);
    }
    public function getKategori(Layanan $layanan)
    {
        return $layanan->kategori()->select('id', 'kategori')->get();
    }
}
