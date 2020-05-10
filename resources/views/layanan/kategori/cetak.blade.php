@extends('layouts/app')
@section('title','Hasil Pengisian Layanan')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-10"></div>
		<h1 class="mt-2">Daftar Soal</h1>
    </div>
    	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>ID Soal</th>
				<th>Jumlah Nilai</th>
				<th>Jumlah Reponden</th>
				<th>Rata Per Soal</th>
			</tr>
		</thead>
		<tbody>
			
			@foreach ($soal as $key=>$datasoal)
			@if ($datasoal->layanan_id==$kategori->layanan_id)
				<p hidden> {{$jumlahsoallayanan=$datasoal->layanan_id}}</p>	
			@endif
			{{-- {{$datasoal}} --}}
			@endforeach
			@foreach($jawaban as $key=>$dataJawaban)
			<tr>
				<td>{{$loop->iteration}}</td>			
				<td>{{$jumlah=$dataJawaban->sum('nilai')}}</td>
				<td>{{$responden=$dataJawaban->get()->count()/$jumlahsoallayanan}}</td>
				<td>{{$jumlah/$responden}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</body>
<center>
<a href="{{url('/cetak/cetak_pdf')}}" class="btn btn-primary my-2">Cetak Laporan</a>
</center>
</div>
@endsection
