@extends('layouts/app')
@section('title','Edit Evaluasi ITK')
@section('content')
<div class="box">
    <div class="box-header with-border">
		<a href="{{url('layanan')}}" class="btn btn-danger my-2 ">Kembali</a>
                <div class="box-body">
	<form method="post" action="{{route('layanan.update',$layanan->id)}}">
		@method('put')
		@csrf
		
		<div class="form-group">
			<label for="layanan">Layanan</label>
			<input type="text" class="form-control" id="layanan" placeholder="Masukkan layanan" name="layanan"value="{{$layanan->layanan}}">
		</div>
		
		<button type="submit" class="btn btn-success">Ubah Data</button>
	</form>
</div>
	</div>
</div>
@endsection