<?php

namespace App\Http\Controllers;

use App\Jawaban;
use App\Soal;
use App\Kategori;
use App\Layanan;
use Illuminate\Http\Request;
use PDF;

class CetakController extends Controller
{
    public function index(Kategori $kategori)
    {
        $jawaban = $kategori->jawaban()->get();
        $soal = Soal::all();
        $layanan = Layanan::all();
        return view('layanan.kategori.cetak', [
            'layanan' => $layanan,  'kategori' => $kategori,
            'jawaban' => $jawaban, 'soal' => $soal
        ]);
    }

    public function cetak_pdf()
    {
        $jawaban = Jawaban::all();

        $pdf = PDF::loadview('layanan.kategori.cetak_pdf', ['jawaban' => $jawaban]);
        return $pdf->download('laporan-laporan-pdf');
    }
}
