@extends('layouts/app')
@section('title','Tambah Kategori Layanan')
@section('content')

<div class="box">

    <div class="box-header with-border">
        <a href="{{url('layanan')}}" class="btn btn-danger my-2 ">Kembali</a>
		<div class="box-tools pull-right">
		</div>
    </div>

    <div class="box-body">

        <div class="form-row">
            <div class="form-group">
				<label for="layanan">Layanan</label>
                <input type="text" class="form-control" value="{{$layanan->layanan}}" id="layanan" disabled>
            </div>

            

		<form method="post" action="{{url('layanan/create-kategori/'.$layanan->id)}}">
				@csrf
				<div class="form-group">
					<label for="kategori">Penanggungjawab</label>
					<select for="user_id" id="user_id" name="user_id" class="form-control">
						@foreach ($user as $user)
						<option  value="{{$user->id}}"> 
							{{$user->name}}
						</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="kategori">Kategori</label>
					<input type="text" name="kategori" class="form-control @error('kategori') is-invalid @enderror" id="kategori" placeholder="Masukkan kategori layanan">
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

<div class="box">
	<div class="box-header with-border">
		<h4><b>Daftar Kategori Layanan</b></h4>
	</div>

	<div class="box-body">

		<table class="table">

			<thead>
				<th>
					<tr>
						<th>No</th>
						<th>Kategori</th>
						<th>Aksi</th>
					</tr>
				</th>
			</thead>
			<tbody>
				@foreach ($kategori as $key => $dataKategori)
					<tr>
						<td>{{$kategori->firstItem() + $key}}</td>
						<td>{{$dataKategori->kategori}}</td>
						<td>
						<a href="{{url('cetak',$dataKategori->id)}}" class="d-inline p-2">
								<button type="button" class="btn btn-info btn-sm">Cetak Laporan</button>
							</a>
						<a href="{{route('kategori.edit',$dataKategori->id)}}" class="d-inline p-2">
								<button type="button" class="btn btn-warning btn-sm">Edit</button>
							</a>
							<a href="" class="d-inline p-2">
								<button type="button" class="btn btn-danger btn-sm">Delete</button>
							</a>
						</td>
					</tr>
				@endforeach
				
			</tbody>

		</table>

		{{$kategori->links()}}

	</div>

</div>

@endsection