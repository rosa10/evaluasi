@extends('layouts.app')

@section('content')
<div class="box">
    <div class="box-body">
<div class="box-header with-border">
        <a href="{{url('chart')}}" class="btn btn-danger my-2 ">Kembali</a>
        <div class="box-tools pull-right">
        </div>
    </div>
        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th>Soal</th>
                    <th>Jumlah Nilai</th>
                    <th>Jumlah Responden</th>
                    <th>Rata Per Soal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($soalPerLayanan as $soal)
                <tr>
                    {{-- {{$periode}} --}}
                    <td>{{$soal->soal}}</td>
                    @if ($periode==1)
                    <td>{{$nilai = $soal->jawaban()->where('kategori_id', $kategori)->where('ganjil',  1)
                    ->where('tahun',$tahun)->sum('nilai')}}
                    </td>
                    <td>{{$responden = $soal->jawaban()->where('kategori_id', $kategori)->where('ganjil',  1)
                    ->where('tahun',$tahun)->count()}}</td>
                    <td>{{round($nilai/$responden,2)}}</td>
                    @else
                    <td>{{$nilai = $soal->jawaban()->where('kategori_id', $kategori)->where('genap',  1)
                    ->where('tahun',$tahun)->sum('nilai')}}
                    </td>
                    <td>{{$responden = $soal->jawaban()->where('kategori_id', $kategori)->where('genap',  1)
                    ->where('tahun',$tahun)->count()}}</td>
                    <td>{{round($nilai/$responden,2)}}</td>
                    @endif
                    
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="row" style="margin-top: 12px">
            <div class="col-md-12 text-center">
                <a href="{{url('/pdf')}}" class="btn btn-primary my-2">Cetak Laporan</a>
            </div>
        </div>
    </div>


</div>
@endsection