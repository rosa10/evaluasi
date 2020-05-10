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
			
			@foreach($jawaban as $key=>$dataJawaban)
			<tr>
				<td>{{$loop->iteration}}</td>			
				<td>{{$jumlah=$dataJawaban->sum('nilai')}}</td>
				<td>{{$responden=$dataJawaban->get()->count()/$soal->whereIn('layanan_id',[$dataJawaban->id])->count()}}</td>
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
