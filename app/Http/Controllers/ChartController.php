<?php

namespace App\Http\Controllers;

use App\Charts\Charts;
use App\User;
use App\Jawaban;
use App\Soal;
use App\Kategori;
use App\Layanan;
use DB;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index(Kategori $kategori)
    {
        $jawaban = Jawaban::all();
        $soal = Soal::all();
        $layanan = Layanan::all();
        $user = User::all();
        $chart = new Charts;
        // $a = 0;
        // foreach ($soal as $datasoal) {
        //     if ($datasoal->layanan_id == $kategori->layanan_id) {
        //         $a++;
        //     }
        // }
        $c[] = 0;
        foreach ($user as $user) {
            $c[]++;
            // $jumlah = $dataJawaban->sum('nilai');
            // $responden = $dataJawaban->where('kategori_id', $kategori->id)->get()->count() / $a;
            // $jumlah / $responden;
        }

        // foreach ($user as $user) {
        //     $b[] = $user->id;
        // }

        $chart->labels($c);
        $chart->dataset('My dataset', 'bar', [1, 2, 3, 4]);
        // $chart->dataset('My dataset 2', 'line', [4, 3, 2, 1]);
        return view('Chart.Chart', compact('chart'));
    }
}
