@extends('layouts/app')
@section('title','Edit Evaluasi ITK')
@section('content')
<div class="box">
	<div class="box-header with-border">
    <a href="{{url('kategori')}}" class="btn btn-danger my-2 ">Kembali</a>
                <div class="box-body">
	<form method="post" action="{{route('kategori.update',$kategori->id)}}">
		@method('put')
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
			<label for="kategori">Kategori</label>
			<input type="text" class="form-control" id="kategori" placeholder="Masukkan indikator" name="kategori"value="{{$kategori->kategori}}">
		</div>
		
		<button type="submit" class="btn btn-primary">Ubah Data</button>
	</form>
</div>
	</div></div>
@endsection