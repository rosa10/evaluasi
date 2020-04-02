@extends('layouts/app')
@section('title','Tambah Evaluasi ITK')
@section('content')
<div class="box">
    <div class="box-header with-border">
      <a href="{{url('pilihan')}}" class="btn btn-danger my-2 ">Kembali</a>
            <div class="box-tools pull-right">
            </div></div>
                <div class="box-body">
	<form method="post" action="{{route('pilihan.store')}}">
		@method('post')
		@csrf
		<div class="form-group">
			<label for="pilihan">Pilihan</label>
			<input type="text" class="form-control" id="pilihan" placeholder="Masukkan indikator" name="pilihan">
		</div>
		<div class="form-group">
			<label for="value">Value</label>
			<input type="text" class="form-control" id="value" placeholder="Masukkan indikator" name="value">
		</div>
		
		<button type="submit" class="btn btn-primary">Tambah Data</button>
	</form>
</div>
@endsection