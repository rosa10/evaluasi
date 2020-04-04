@extends('layouts/app')
@section('title','Edit Evaluasi ITK')
@section('content')
<div class="box">
    <div class="box-header with-border">
      <a href="{{url('layanan/create')}}" class="btn btn-primary my-2 ">Tambah Layanan</a>
            <div class="box-tools pull-right">
            </div></div>
                <div class="box-body">
                  @include('partials.alerts')
                   <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">User</th>
                        <th scope="col">Layanan</th>
					            	<th scope="col">Semester</th>
						            <th scope="col"width="250px">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($layanan as $layanan)
                        <tr>
                        <td>{{$loop->iteration}}</td>
                          <td>
                            {{implode(', ',$layanan->user()->get()->pluck('name')->sort()->toArray())}}
                          </td>
                          <td>{{$layanan->layanan}}</td>
                          <td>{{$layanan->semester}}</td>
                          <td class="pull-left">
                            <a href="{{url('layanan/create-kategori/'.$layanan->id)}}">
                              <button type="button" class="btn btn-warning btn-sm mr-2"><i class="fa fa-plus"></i> Kategori</button>
                            </a>

                            <a href="{{route('layanan.edit',$layanan->id)}}">
                              <button type="button" class="btn btn-primary btn-sm mr-2">Edit</button>
                            </a>

                            <button id="tombolHapusData"
                                    class="btn btn-danger btn-sm delete-data"
                                    data-name="{{ $layanan->layanan }}" data-toggle="modal"
                                    data-target="#modalHapusData"
                                    data-url="{{url('layanan/'.$layanan->id)}}"><i
                                        class="fa fa-trash"></i>
                                    Delete
                                </button>
                          </td>
                          
                        </tr>
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
                </div>
            </div>
        </div>
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
              $("#modalHapusData").find(".modal-body").text("Apakah anda ingin menghapus layanan " + nama + "?");
              $("#deleteForm").attr("action", url);
          });
      });
  </script>
@endsection