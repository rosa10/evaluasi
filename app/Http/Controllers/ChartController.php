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
        // dd($request);
        $soal = Soal::where('layanan_id', $request->layanan_id)->get();

        return view('Chart.Chart2', [
            'soal' => $soal,
            'kategori' => $request->kategori_id,
            'periode' => $request->periode,
            'tahun' => $request->tahun
        ]);
    }

    public function chartData(Kategori $kategori, Request $request)
    {

        $soal = Soal::where('layanan_id', $kategori->layanan->id)->get();
        $namaSoal = [];
        $periode = $request->periode;
        $tahun = $request->tahun;

        foreach ($soal as $itemSoal) {
            $pilihan = [];
            $nilai = [];
            if ($periode == 1) {
                foreach ($itemSoal->pilihan as $itemPilihan) {
                    array_push($pilihan, $itemPilihan->pilihan);
                    array_push($nilai,  $itemSoal->jawaban()->where('nilai', $itemPilihan->value)->where('kategori_id', $kategori->id)->where('ganjil', 1)->where('tahun', $tahun)->count());
                }
            } else {
                foreach ($itemSoal->pilihan as $itemPilihan) {
                    array_push($pilihan, $itemPilihan->pilihan);
                    array_push($nilai,  $itemSoal->jawaban()->where('nilai', $itemPilihan->value)->where('kategori_id', $kategori->id)->where('genap', 1)->where('tahun', $tahun)->count());
                }
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


    public function hasil(Request $request)
    {
        $soal = Soal::where('layanan_id', $request->layanan_id)->get();
        $periode = $request->periode;
        $tahun = $request->tahun;

        return view('Chart.hasil', [
            'soalPerLayanan' => $soal,
            'kategori' => $request->kategori_id,
            'periode' => $periode,
            'tahun' => $tahun
        ]);
    }

    public function status(Request $request)
    {
        $kategori = $request->kategori_id;
        $tahun = $request->tahun;
        $periode = $request->periode;

        $user = User::whereHas('roles', function ($query) {
            $query->where('name', 'responden');
        })->whereDoesntHave('jawaban', function ($query) use ($kategori, $tahun, $periode) {
            if ($periode == 1) {
                $query->where('kategori_id', $kategori)->where('tahun', $tahun)->where('ganjil', 1);
            } else {
                $query->where('kategori_id', $kategori)->where('tahun', $tahun)->where('genap', 1);
            }
        })->get();

        return view('Chart.status', [
            'userTanpaJawaban' => $user
        ]);
    }
}
