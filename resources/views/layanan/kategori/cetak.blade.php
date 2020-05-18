@extends('layouts/app')
@section('title','Hasil Pengisian Layanan')
@section('content')
<div class="box">
	<div class="box-header with-border">
        <a href="{{url('layanan')}}" class="btn btn-danger my-2 ">Kembali</a>
		<div class="box-tools pull-right">
		</div>
	</div>
	<div class="box-body">
		 
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
			<p hidden >{{$a=0}}</p>
			@foreach ($soal as $key=>$datasoal)
				@if ($datasoal->layanan_id==$kategori->layanan_id)
					<p hidden> {{$a++}}</p>	
				@endif
			@endforeach
			<p hidden> {{$b=$a}} </p>
			@foreach ($soal as $key=>$datasoal)
				@foreach ($jawaban as $ajawaban)
					@if ($b>0)
						@if ($datasoal->id==$ajawaban->soal_id)
							<tr>
								<td>{{$loop->iteration}}</td>	
								<td>{{$jumlah=$ajawaban->where('kategori_id',$kategori->id)->where('soal_id',$datasoal->id)->sum('nilai')}}</td>
								<td>{{$responden=$ajawaban->where('kategori_id',$kategori->id)->get()->count()/$a}}</td>
								<td>{{$jumlah/$responden}}</td>
							</tr>
							<p hidden> {{$b--}}</p>
						@endif
					@endif
				@endforeach
			@endforeach
		</tbody>
	</table>

</body>
<center>
<a href="{{url('/cetak/cetak_pdf',$kategori->id)}}" class="btn btn-primary my-2">Cetak Laporan</a>
</center>
</div>
@endsection
