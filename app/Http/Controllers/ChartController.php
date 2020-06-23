<?php

namespace App\Http\Controllers;

use App\Charts\Charts;
use App\User;
use App\Jawaban;
use App\Soal;
use App\Kategori;
use App\Layanan;
use App\Pilihan;
use DB;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {

        $layanan = Layanan::all();
        $kategori = Kategori::all();
        return view('chart.chart', [
            'layanan' => $layanan,
            'kategori' => $kategori
        ]);
    }
    public function chart(Request $request)
    {

        $soal = Soal::all();


        return view('Chart.Chart2', [
            'soal' => $soal,
        ]);
    }

    public function chartData()
    {
        $soal = Soal::all();
        $namaSoal = [];

        foreach ($soal as $itemSoal) {
            $pilihan = [];
            $nilai = [];

            foreach ($itemSoal->pilihan as $itemPilihan) {
                array_push($pilihan, $itemPilihan->pilihan);
                array_push($nilai,  $itemSoal->jawaban->where('nilai', $itemPilihan->value)->count());
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
}
