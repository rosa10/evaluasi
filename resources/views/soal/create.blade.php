@extends('layouts/app')
@section('title','Tambah Evaluasi ITK')
@section('content')
<div class="box">
    <div class="box-header with-border">
      <a href="{{url('soal')}}" class="btn btn-danger my-2 ">Kembali</a>
            <div class="box-tools pull-right">
            </div></div>
                <div class="box-body">
	<form method="post" action="{{route('soal.store')}}">
		@method('post')
		@csrf
		<div class="form-group">
			<select for="layanan_id" id="layanan_id" name="layanan_id" class="form-control">
				@foreach ($layanan as $layanan)
				<option  value="{{$layanan->id}}"> 
					{{$layanan->layanan}}
				</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label for="soal">Soal</label>
			<input type="text" class="form-control" id="soal" placeholder="Masukkan indikator" name="soal">
		</div>
		<div class="form-group">
			<label for="checkbox">Pilihan</label>
      		@foreach($pilihan as $plh)
      			<div class="form-check">
      			<input type="checkbox" name="pilihan[]" value="{{$plh->id}}">
      			<label>{{$plh->pilihan}} Value:{{$plh->value}}</label>
      			</div>
	  		@endforeach
		</div>
		<button type="submit" class="btn btn-primary">Tambah Data</button>
	</form>
</div>
@endsection