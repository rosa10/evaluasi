<html>
	<head>
	<title>Hasil Pengisian Evaluasi</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-10"></div>
	<h3 class="mt-2">Hasil Pengisian{{implode(', ',$kategori->layanan()->get()->pluck('layanan')->sort()->toArray())}}
                          			{{$kategori->kategori}}</h3>
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
</html>
