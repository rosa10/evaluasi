@extends('layouts/app')
@section('title','Tambah Evaluasi ITK')
@section('content')
<div class="box">
    <div class="box-header with-border">
      <a href="{{url('layanan')}}" class="btn btn-danger my-2 ">Kembali</a>
            <div class="box-tools pull-right">
            </div></div>
                <div class="box-body">
	<form method="post" action="{{route('layanan.store')}}">
		@method('post')
		@csrf
		
		<div class="form-group">
			<label for="layanan">Layanan</label>
			<input type="text" class="form-control" id="layanan" placeholder="Masukkan layanan" name="layanan">
		</div>
		
		<button type="submit" class="btn btn-primary">Tambah Data</button>
	</form>
</div>
@endsection