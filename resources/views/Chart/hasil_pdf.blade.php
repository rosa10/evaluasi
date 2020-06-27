<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>

	<style>
		body{
			font-family:'Nunito', sans-serif;
		}
		p{
			line-height: 1.5;
		}
		hr{
			margin-top:1rem;
			margin-bottom:1rem;
			border: 0;
			border-top:1px solid rgba(0,0,0,0.1);
		}
		h2{
			line-height: 1.5;
		}
		table{
			margin-bottom:1 rem;
		}
		.table td{
			padding:0.75 rem;
			vertical-align: top;
		}
		table {
			border-collapse:collapse;
			width:100%;
		}
		table, th,td{
			border:1 px solid black;
			padding: 8px
		}
	</style>
</head>
<body style="font-size:0.85em; border-style:solid; padding:16px">
<h4>Hasil Pengisian Layanan {{$layanan}} {{$namaKategori}} Untuk Semester 
	@if($periode==1)Ganjil
@else 
Genap
@endif Tahun {{$tahun}}</h4>
	<table>
		<thead>
			<tr>
				<th>Soal</th>
				<th style="text-align:center">Jumlah Nilai</th>
				<th style="text-align:center">Jumlah Responden</th>
				<th style="text-align:center">Rata Per Soal</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($soalPerLayanan as $soal)
                <tr>
                    {{-- {{$periode}} --}}
                    <td>{{$soal->soal}}</td>
                    @if ($periode==1)
                    <td align="center">{{$nilai = $soal->jawaban()->where('kategori_id', $kategori)->where('ganjil',  1)
                    ->where('tahun',$tahun)->sum('nilai')}}
                    </td>
                    <td align="center" >{{$responden = $soal->jawaban()->where('kategori_id', $kategori)->where('ganjil',  1)
                    ->where('tahun',$tahun)->count()}}</td>
                    <td align="center">
						@if($responden == 0)
							-
						@else 
							{{round($nilai/$responden,2)}}
						@endif
					</td>
                    @else
                    <td align="center">{{$nilai = $soal->jawaban()->where('kategori_id', $kategori)->where('genap',  1)
                    ->where('tahun',$tahun)->sum('nilai')}}
                    </td>
                    <td align="center">{{$responden = $soal->jawaban()->where('kategori_id', $kategori)->where('genap',  1)
                    ->where('tahun',$tahun)->count()}}</td>
                    <td align="center">@if($responden == 0)
							-
						@else 
							{{round($nilai/$responden,2)}}
						@endif</td>
                    @endif
                    
                </tr>
                @endforeach
		</tbody>
	</table>
	
</body>
</html>