@extends('layouts/app')
@section('title','Edit Evaluasi ITK')
@section('content')
<div class="box">
    <div class="box-header with-border">
		<a href="{{url('pilihan')}}" class="btn btn-danger my-2 ">Kembali</a>
                <div class="box-body">
	<form method="post" action="{{route('pilihan.update',$pilihan->id)}}">
		@method('put')
		@csrf
		<div class="form-group">
			<label for="pilihan">Pilihan</label>
			<input type="text" class="form-control" id="pilihan" placeholder="Masukkan indikator" name="pilihan"value="{{$pilihan->pilihan}}">
		</div>
		<div class="form-group">
			<label for="value">Value</label>
			<input type="text" class="form-control" id="value" placeholder="Masukkan indikator" name="value"value="{{$pilihan->value}}">
		</div>
		
		<button type="submit" class="btn btn-primary">Ubah Data</button>
	</form>
</div>
@endsection