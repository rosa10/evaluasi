@extends('layouts/app')
@section('title','Edit Kategori')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <a href="{{url('layanan') }}" class="btn btn-danger my-2 ">Kembali</a>
    <div class="box-body">
    <form method="post" action="{{route('kategori.update',$kategori->id)}}">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="kategori">Penanggungjawab</label>
			<select for="user_id" id="user_id" name="user_id" class="form-control">
				@foreach ($user as $user)
				<option  value="{{$user->id}}"
					@if ($kategori->user()->get()->pluck('id')->contains($user->id)) selected @endif> 
					{{$user->name}}
				</option>
				@endforeach
			</select>
			</div>
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
</div>
</div>

@endsection