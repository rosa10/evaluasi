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
			<label for="layanan_id">Layanan id</label>
			<input type="text" class="form-control" id="layanan_id" placeholder="Masukkan indikator" name="layanan_id">
		</div>
		<div class="form-group">
			<label for="soal">Soal</label>
			<input type="text" class="form-control" id="soal" placeholder="Masukkan indikator" name="soal">
		</div>
		
		<button type="submit" class="btn btn-primary">Tambah Data</button>
	</form>
</div>
@endsection