@extends('layouts/app')
@section('title','Edit Evaluasi ITK')
@section('content')
<div class="box">
    <div class="box-header with-border">
      <a href="{{url('pilihan/create')}}" class="btn btn-primary my-2 ">Tambah Pilihan</a>
            <div class="box-tools pull-right">
            </div></div>
                <div class="box-body">
                   <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Pilihan</th>
                        <th scope="col">Value</th>
						<th scope="col"width="160px">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($pilihan as $pilihan)
                        <tr>
                        <th>{{$loop->iteration}}</th>
                          <th>{{$pilihan->pilihan}}</th>
                          <th>{{$pilihan->value}}</th>
                          <th>
                            <a href="{{route('pilihan.edit',$pilihan->id)}}" class="pull-left">
                              <button type="button" class="btn btn-primary btn-sm">Edit</button>
                            </a>
                            <button id="tombolHapusData"
                                    class="btn btn-danger btn-sm delete-data"
                                    data-name="{{ $pilihan->pilihan }}" data-toggle="modal"
                                    data-target="#modalHapusData"
                                    data-url="{{url('pilihan/'.$pilihan->id)}}"><i
                                        class="fa fa-trash"></i>
                                    Delete
                                </button>
                            {{-- <form action="{{route('pilihan.destroy',$pilihan->id)}}" method="post" class="pull-right">
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form> --}}
                          </th>
                          
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
              $("#modalHapusData").find(".modal-body").text("Apakah anda ingin menghapus soal " + nama + "?");
              $("#deleteForm").attr("action", url);
          });
      });
  </script>
@endsection