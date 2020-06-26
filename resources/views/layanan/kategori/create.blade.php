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
						{{-- <th>Penanggungjawab</th> --}}
						<th>Aksi</th>
					</tr>
				</th>
			</thead>
			<tbody>
				@foreach ($kategori as $key => $dataKategori)
					<tr>
						<td>{{$kategori->firstItem() + $key}}</td>
						<td>{{$dataKategori->kategori}}</td>
						{{-- <td>{{implode(', ',$dataKategori->user()->get()->pluck('name')->sort()->toArray())}}</td> --}}
						<td>
						{{-- <a href="{{url('cetak',$dataKategori->id)}}" class="d-inline p-2">
								<button type="button" class="btn btn-info btn-sm">Cetak Laporan</button>
							</a> --}}
						<a href="{{route('kategori.edit',$dataKategori->id)}}" class="d-inline p-2">
								<button type="button" class="btn btn-warning btn-sm">Edit</button>
							</a>
							<button id="tombolHapusData"
                                    class="btn btn-danger btn-sm delete-data"
                                    data-name="{{ $dataKategori->kategori }}" data-toggle="modal"
                                    data-target="#modalHapusData"
                                    data-url="{{url('kategori/'.$dataKategori->id)}}"><i
                                        class="fa fa-trash"></i>
                                    Delete
                                </button>
						</td>
					</tr>
				@endforeach
				<!-- Modal -->
				<form action="" method="POST" id="deleteForm">
					@method('delete')
					@csrf
					<div class="modal fade" id="modalHapusData" tabindex="-1" role="dialog"
						aria-labelledby="hapusDataTitle" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">Hapus Data</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body" align="center">
									
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary"
										data-dismiss="modal">Batal</button>

									<button type="submit" class="btn btn-danger">Hapus</button>

								</div>
							</div>
						</div>
					</div>
				</form>
				<!-- EndModal -->
			</tbody>
		</table>
		{{$kategori->links()}}
	</div>
</div>
@endsection
@section('javascript')
    {{-- Button Delete data  --}}
    <script>
      $(document).ready(function () {
          $('.delete-data').click(function () {
              var url = $(this).attr('data-url');
              var nama = $(this).attr('data-name');
              console.log(nama);
              $("#modalHapusData").find(".modal-body").text("Apakah anda ingin menghapus kategori " + nama + "?");
              $("#deleteForm").attr("action", url);
          });
      });
  </script>
@endsection