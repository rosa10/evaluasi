@extends('layouts/app')
@section('title','Edit Kategori')
@section('content')

<div class="box">

    <div class="box-header with-border">
        <a href="#" class="btn btn-danger my-2 ">Kembali</a>
		<div class="box-tools pull-right">
		</div>
    </div>

    <form method="post" action="{{url('layanan/create-kategori/'.$layanan->id)}}">
        @method('patch')
        @csrf
        <div class="form-group">
            <label for="kategori">Kategori</label>
            <input type="text" name="kategori" class="form-control @error('kategori') is-invalid @enderror" id="kategori" placeholder="Masukkan kategori layanan" value="{{$kategori->kategori}}">
        </div>
        @error('kategori') 
                <div class="text-danger">
                    {{ $message }}
                </div>
        @enderror
        <button type="submit" class="btn btn-primary pull-right">Tambah Data</button>
</form>

</div>

@endsection