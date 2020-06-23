@extends('layouts/app')
@section('title','Edit Evaluasi ITK')
@section('content')
<div class="box">
    <div class="box-header with-border">
		<a href="{{url('soal')}}" class="btn btn-danger my-2 ">Kembali</a>
                <div class="box-body">
	<form method="post" action="{{route('soal.update',$soal->id)}}">
		@method('put')
		@csrf
		<div class="form-group">
			<label for="layanan">Layanan</label>
			<select for="layanan_id" id="layanan_id" name="layanan_id" class="form-control">
				@foreach ($layanan as $layanan)
				<option  value="{{$layanan->id}}"
					@if ($soal->layanan()->get()->pluck('id')->contains($layanan->id)) selected @endif> 
					{{$layanan->layanan}}
				</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label for="soal">Pertanyaan</label>
			<input type="text" class="form-control" id="soal" placeholder="Masukkan indikator" name="soal"value="{{$soal->soal}}">
		</div>
		<div class="form-group">
                        <label for="dari"> Dari Tanggal </label>
                        <input type="date" name="dari" value="{{$soal->dari}}"> 
                        <label for="sampai">    Sampai Tanggal </label>
                        <input type="date" name="sampai" value="{{$soal->sampai}}">		
                      </div>
		<div class="form-group">
			<label for="checkbox">Pilihan</label>
      		@foreach($pilihan as $plh)
      			<div class="form-check">
				  <input type="checkbox" name="pilihan[]" value="{{$plh->id}}"
				  @if($soal->pilihan->pluck('id')->contains($plh->id)) checked @endif>
      			<label>{{$plh->pilihan}} Value:{{$plh->value}}</label>
      			</div>
	  		@endforeach
		</div>
		<button type="submit" class="btn btn-primary">Ubah Data</button>
	</form>
</div>
@endsection